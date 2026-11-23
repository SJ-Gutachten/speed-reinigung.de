<?php
/**
 * Einstellungen der Website.
 *
 * Abweichende Werte für einen Server gehören in eine Datei config.local.php
 * im Hauptverzeichnis (wird nicht ins Repository übernommen), z. B.:
 *
 *   <?php return ['mail_to' => 'test@example.org'];
 */
return [
    // Empfänger der Kontaktanfragen.
    'mail_to'   => 'info@speed-reinigung.de',

    // Absender der Benachrichtigung. Muss eine Adresse der eigenen Domain sein,
    // sonst lehnen Mailserver die Nachricht ab. Geantwortet wird an den Anfragenden (Reply-To).
    'mail_from' => 'kontaktformular@speed-reinigung.de',
    'mail_from_name' => 'Speed-Reinigung Website',

    'mail_subject' => 'Neue Anfrage über das Kontaktformular',

    // true = Mail nicht senden, sondern nach storage/testmail.txt schreiben (nur für lokale Tests).
    'mail_dry_run' => false,

    // Spamschutz
    'min_seconds'   => 3,       // schneller ausgefüllt = Bot
    'max_seconds'   => 86400,   // Formular älter als 24 h = neu laden
    'max_per_hour'  => 5,       // Anfragen je Besucher und Stunde
    'max_links'     => 3,       // mehr Links in der Nachricht = Spam
];
