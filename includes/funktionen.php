<?php
/**
 * Gemeinsame Hilfsfunktionen für alle Seiten und den Formular-Handler.
 */

/** Text sicher in HTML ausgeben. */
function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Adresse einer eigenen CSS- oder JS-Datei mit Versionsangabe (Änderungszeit der Datei).
 * Browser speichern diese Dateien eine Woche; durch die Version laden sie geänderte Dateien sofort neu.
 */
function asset(string $pfad): string
{
    $datei = dirname(__DIR__) . $pfad;

    return $pfad . (is_file($datei) ? '?v=' . filemtime($datei) : '');
}

/**
 * Attribute für interne Links in Header und Footer.
 * Markiert den Link der aktuellen Seite so, wie Webflow es getan hat
 * (aria-current="page" und Klasse w--current).
 */
function nav_attrs(string $href, string $class): string
{
    global $page;
    $aktiv = isset($page['path']) && $page['path'] === $href;

    return 'href="' . e($href) . '"'
        . ($aktiv ? ' aria-current="page"' : '')
        . ' class="' . e($class) . ($aktiv ? ' w--current' : '') . '"';
}

/** Einstellungen laden: includes/config.php, optional überschrieben durch config.local.php. */
function config(): array
{
    static $config = null;
    if ($config === null) {
        $config = require __DIR__ . '/config.php';
        $lokal = dirname(__DIR__) . '/config.local.php';
        if (is_file($lokal)) {
            $config = array_replace($config, require $lokal);
        }
    }

    return $config;
}

/** Schreibbarer, per .htaccess gesperrter Ordner für Schlüssel und Zähler. */
function storage_dir(): string
{
    $dir = dirname(__DIR__) . '/storage';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }

    return $dir;
}

/** Geheimer Schlüssel für Formular-Tokens; wird beim ersten Aufruf auf dem Server erzeugt. */
function app_secret(): string
{
    $datei = storage_dir() . '/secret.key';
    $secret = is_file($datei) ? trim((string) file_get_contents($datei)) : '';
    if ($secret === '') {
        $secret = bin2hex(random_bytes(32));
        @file_put_contents($datei, $secret, LOCK_EX);
    }

    return $secret;
}

/** Zeitstempel-Token für das Kontaktformular (Spamschutz: Mindest- und Höchstalter). */
function form_token(): string
{
    $zeit = (string) time();

    return $zeit . '.' . hash_hmac('sha256', $zeit, app_secret());
}

/** Alter eines Tokens in Sekunden oder null, wenn es ungültig ist. */
function form_token_age(string $token): ?int
{
    $teile = explode('.', $token, 2);
    if (count($teile) !== 2 || !ctype_digit($teile[0])) {
        return null;
    }
    if (!hash_equals(hash_hmac('sha256', $teile[0], app_secret()), $teile[1])) {
        return null;
    }

    return time() - (int) $teile[0];
}
