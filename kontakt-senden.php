<?php
/**
 * Empfängt das Kontaktformular von /kontakt und verschickt die Anfrage per E-Mail.
 *
 * Mit JavaScript antwortet das Skript mit JSON (Erfolgs-/Fehlermeldung erscheint im Formular),
 * ohne JavaScript leitet es auf /success bzw. zurück auf /kontakt weiter.
 *
 * Spamschutz: verstecktes Feld (Honeypot), Zeitstempel-Token, Begrenzung je Besucher,
 * Link-Begrenzung und Prüfung aller Eingaben auf dem Server. Es werden keine Anfragen gespeichert.
 */
require __DIR__ . '/includes/funktionen.php';

$config   = config();
$willJson = stripos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false;

function antworten(bool $ok, int $status, bool $willJson, string $grund = ''): void
{
    header('Cache-Control: no-store');
    if ($willJson) {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => $ok, 'grund' => $grund]);
    } else {
        header('Location: ' . ($ok ? '/success' : '/kontakt?fehler=1'), true, 303);
    }
    exit;
}

function feld(string $name, int $max): string
{
    $wert = $_POST[$name] ?? '';
    if (!is_string($wert)) {
        return '';
    }
    $wert = trim(str_replace("\0", '', $wert));

    return function_exists('mb_substr') ? mb_substr($wert, 0, $max, 'UTF-8') : substr($wert, 0, $max);
}

/** Entfernt Zeilenumbrüche, damit niemand zusätzliche Mail-Header einschleusen kann. */
function einzeilig(string $text): string
{
    return trim(preg_replace('/[\r\n\t]+/', ' ', $text));
}

function kopfzeile(string $text): string
{
    return '=?UTF-8?B?' . base64_encode($text) . '?=';
}

/** Zählt Anfragen je Besucher (IP nur als Hash) und meldet, ob das Limit erreicht ist. */
function limit_erreicht(int $maxProStunde): bool
{
    $dir = storage_dir() . '/limit';
    if (!is_dir($dir) && !@mkdir($dir, 0755, true)) {
        return false;
    }
    $datei = $dir . '/' . hash_hmac('sha256', $_SERVER['REMOTE_ADDR'] ?? '', app_secret()) . '.json';
    $jetzt = time();
    $zeiten = is_file($datei) ? (json_decode((string) file_get_contents($datei), true) ?: []) : [];
    $zeiten = array_values(array_filter($zeiten, static fn ($t) => is_int($t) && $t > $jetzt - 3600));
    if (count($zeiten) >= $maxProStunde) {
        return true;
    }
    $zeiten[] = $jetzt;
    @file_put_contents($datei, json_encode($zeiten), LOCK_EX);

    if (random_int(1, 50) === 1) { // gelegentlich alte Zähler aufräumen
        foreach (glob($dir . '/*.json') ?: [] as $alt) {
            if (filemtime($alt) < $jetzt - 7200) {
                @unlink($alt);
            }
        }
    }

    return false;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: /kontakt', true, 303);
    exit;
}

// Honeypot: echte Besucher sehen das Feld nicht. Bots bekommen eine Erfolgsmeldung, aber es wird nichts gesendet.
if (feld('website', 200) !== '') {
    antworten(true, 200, $willJson);
}

$alter = form_token_age(feld('_ts', 200));
if ($alter === null || $alter > $config['max_seconds']) {
    antworten(false, 400, $willJson, 'abgelaufen');
}
if ($alter < $config['min_seconds']) {
    antworten(false, 400, $willJson, 'zu_schnell');
}

$vorname   = einzeilig(feld('Vorname', 256));
$nachname  = einzeilig(feld('Nachname', 256));
$email     = einzeilig(feld('E-Mail', 256));
$nachricht = feld('Ihre-Nachricht', 5000);
$zustimmung = feld('Datenschutzzustimmung', 10) !== '';

if ($vorname === '' || $nachname === '' || !$zustimmung || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    antworten(false, 422, $willJson, 'eingabe');
}
if (preg_match_all('~https?://|www\.~i', $nachricht) > $config['max_links']) {
    antworten(false, 422, $willJson, 'eingabe');
}
if (limit_erreicht($config['max_per_hour'])) {
    antworten(false, 429, $willJson, 'limit');
}

$text = "Neue Anfrage über das Kontaktformular auf speed-reinigung.de\n\n"
    . "Vorname:   $vorname\n"
    . "Nachname:  $nachname\n"
    . "E-Mail:    $email\n"
    . "Datenschutzerklärung zur Kenntnis genommen und Speicherung zugestimmt: ja\n\n"
    . "Nachricht:\n" . ($nachricht !== '' ? $nachricht : '(keine Nachricht eingegeben)') . "\n";

$header = [
    'From: ' . kopfzeile($config['mail_from_name']) . ' <' . $config['mail_from'] . '>',
    'Reply-To: ' . kopfzeile("$vorname $nachname") . ' <' . $email . '>',
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'Content-Transfer-Encoding: 8bit',
];

if (!empty($config['mail_dry_run'])) {
    // Nur für lokale Tests (config.local.php): Mail in eine Datei schreiben statt senden.
    file_put_contents(storage_dir() . '/testmail.txt', implode("\n", $header) . "\n\n" . $text);
    antworten(true, 200, $willJson);
}

$gesendet = @mail(
    $config['mail_to'],
    kopfzeile($config['mail_subject']),
    str_replace(["\r\n", "\r"], "\n", $text),
    implode("\r\n", $header),
    '-f' . $config['mail_from']
);

if (!$gesendet) {
    error_log('Kontaktformular: mail() fehlgeschlagen'); // ohne Inhalte der Anfrage
    antworten(false, 500, $willJson, 'versand');
}

antworten(true, 200, $willJson);
