# speed-reinigung.de

Website der Speed Gebäudereinigung München. Ursprünglich in Webflow gebaut, im November 2026
als schlanke PHP-Seite für das Hosting bei Hostinger aufbereitet. Design und Texte entsprechen
dem Webflow-Stand vom 13.05.2026.

- `ANALYSE.md` – Bestandsaufnahme des Webflow-Stands, Auffälligkeiten, bisherige URLs, DNS
- `CLAUDE.md` – Arbeitsregeln für die Bearbeitung mit Claude

## Aufbau

```
index.php, leistungen.php, galerie.php,      eine Datei pro Seite: Seitendaten ($page) + Inhalt
kontakt.php, success.php, impressum.php,
datenschutz.php, 404.php
kontakt-senden.php                           Empfänger des Kontaktformulars (verschickt die E-Mail)
includes/
  head.php                                   <head>: Titel, Meta-Angaben, CSS, Tracking-Code
  header.php                                 Logo, Navigation, Button „Jetzt kostenlos anfragen“
  footer.php                                 Kontaktblock am Seitenende, Skripte
  funktionen.php                             Hilfsfunktionen (Ausgabe, aktive Navigation, Formular-Token)
  config.php                                 Einstellungen (E-Mail-Empfänger, Spamschutz)
assets/
  css/speed-reinigung.css                    gesamtes Styling (aus Webflow übernommen)
  js/                                        jQuery, webflow.js (Menü, Animationen), kontaktformular.js
  img/                                       alle Bilder
storage/                                     Laufzeitdaten des Formulars (nicht im Repository, per .htaccess gesperrt)
.htaccess                                    Adressen ohne .php, Weiterleitungen, Schutz, Cache
robots.txt, sitemap.xml
```

Das Hauptverzeichnis des Repositorys ist zugleich das Web-Verzeichnis (`public_html`).

## Eine Seite bearbeiten

Jede Seite beginnt mit einem Block `$page = [...]` (Adresse, Titel, Beschreibung). Darunter steht der
Inhalt als HTML. Header und Footer werden eingebunden und stehen nur einmal in `includes/`.

Neue Seite anlegen:

1. Eine bestehende Seite kopieren, z. B. `success.php` → `preise.php`.
2. In `$page` `path` (`/preise`), `title` und `description` anpassen. `wf_page` und `webflow_js` übernehmen.
3. Die Seite ist unter `/preise` erreichbar. In `sitemap.xml` eintragen und bei Bedarf in `includes/header.php` verlinken.

## Kontaktformular

`kontakt.php` schickt die Eingaben an `kontakt-senden.php`. Der Empfänger steht in `includes/config.php`
(`mail_to`, voreingestellt `info@speed-reinigung.de`). Anfragen werden nur per E-Mail verschickt und
nicht auf dem Server gespeichert.

Spamschutz ohne Drittanbieter: verstecktes Feld, Mindestzeit von 3 Sekunden zwischen Seitenaufruf und
Absenden, höchstens 5 Anfragen je Besucher und Stunde, höchstens 3 Links in der Nachricht.

Abweichende Einstellungen für einen einzelnen Server gehören in eine Datei `config.local.php` im
Hauptverzeichnis. Sie wird nicht ins Repository übernommen.

## Lokal testen

Benötigt Apache mit `mod_rewrite` und PHP ab 7.4 (z. B. Laragon), Web-Verzeichnis ist der Repository-Ordner.
Damit lokal keine E-Mails verschickt werden, `config.local.php` anlegen:

```php
<?php return ['mail_dry_run' => true];
```

Testanfragen landen dann in `storage/testmail.txt`.

## Veröffentlichen

- `main` ist der veröffentlichte Stand. Hostinger übernimmt jeden Push auf `main` automatisch nach `public_html`.
- Gearbeitet wird auf einem eigenen Branch (aktuell `umbau`). Erst nach Prüfung wird nach `main` übernommen.
- Nach dem Veröffentlichen prüfen: Startseite, `/kontakt` mit einer Testanfrage, `/kontakt/` und `/index.html` (müssen weiterleiten), eine erfundene Adresse (muss die 404-Seite zeigen).

## Bewusste Abweichungen vom Webflow-Original

- Kontaktformular sendet an `kontakt-senden.php` statt an Webflow und enthält zwei unsichtbare Spamschutz-Felder.
- Die Webflow-Seite `/401` (Passwortschutz) entfällt; sie wurde nirgends verwendet.
- Die 404-Seite ist deutsch und im Design der Website statt der englischen Webflow-Standardseite.
- CSS, JavaScript und Bilder liegen lokal statt auf dem Webflow-CDN; die Dateien haben sprechende Namen.
- `/index.html` und Adressen mit `.html` oder `.php` leiten auf die Adresse ohne Endung weiter.

Alles Weitere – Texte, Impressum, Datenschutz, Tracking- und Cookie-Code, Schriften, Animationen – ist unverändert.
