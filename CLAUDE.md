# speed-reinigung.de – Arbeitsregeln

Statische Firmenwebsite in PHP (nur Includes, kein Framework, kein Build-Schritt), gehostet bei Hostinger.
Aus Webflow übernommen; Struktur und Ablauf stehen in `README.md`, der Ausgangszustand in `ANALYSE.md`.

## Nicht ohne ausdrücklichen Auftrag ändern

- `impressum.php` und `datenschutz.php` (Rechtstexte), auch keine „harmlosen“ Tippfehler.
- Tracking- und Einwilligungs-Code in `includes/head.php` (Google Tag Manager, consentmanager).
- Texte und Design der Seiten. Auffälligkeiten aus `ANALYSE.md` werden nur auf Wunsch behoben.
- DNS, insbesondere die E-Mail-Einträge (MX, SPF, DKIM, DMARC).

## Branches und Deploy

- `main` = veröffentlichter Stand; Hostinger deployt jeden Push auf `main` nach `public_html`.
- Änderungen auf einem Branch (derzeit `umbau`), nie direkt auf `main`. Merge nur nach Freigabe.
- Erster Commit auf `main` ist der unveränderte Webflow-Export und dient als Vergleichsstand.

## Konventionen

- Sprache: Deutsch in Texten, Kommentaren, Commit-Nachrichten und Dateinamen.
- Eine Datei pro Seite im Hauptverzeichnis; die Adresse ist der Dateiname ohne `.php`.
- Jede Seite setzt `$page` und bindet `includes/head.php`, `includes/header.php` und `includes/footer.php` ein.
  Header und Footer nur dort ändern, nie in einzelne Seiten kopieren.
- Interne Links ohne Endung und ohne Schrägstrich am Ende (`/kontakt`), Assets mit absolutem Pfad (`/assets/...`).
- Links in Header und Footer über `nav_attrs()` ausgeben, damit die aktive Seite markiert wird.
- Variable Ausgaben in PHP immer mit `e()` maskieren.
- Dateinamen: Kleinbuchstaben, Bindestriche, keine Umlaute. Bilder nach `assets/img`,
  Varianten in anderer Breite mit Endung `-p-500`, `-p-800`, `-p-1080`.
- Styling steht in `assets/css/speed-reinigung.css` (Webflow-Klassennamen). Neue Regeln ans Dateiende.

## Stolpersteine

- `assets/js/webflow.*.js` und jQuery sind unveränderte Webflow-Dateien: nicht bearbeiten, nicht umbenennen.
  Sie steuern Menü und Einblend-Animationen.
- `data-wf-page` im `<html>`-Tag (Wert `wf_page` in `$page`) und alle `data-w-id`-Attribute müssen bleiben,
  sonst bleiben animierte Bereiche unsichtbar (`opacity:0`).
- Der HTML-Inhalt der Seiten steht bewusst ohne Einrückung, ein Blockelement pro Zeile. Zwischen
  Inline-Elementen keine Zeilenumbrüche einfügen – das verändert Abstände.
- `kontakt.php` darf nicht gecacht werden (zeitgebundenes Formular-Token).
- `storage/` und `config.local.php` gehören nicht ins Repository.

## Prüfen nach Änderungen

Lokal mit Apache + PHP (siehe `README.md`):

- Alle Seiten laden ohne Fehler in der Browser-Konsole, Desktop und 375 px Breite.
- Mobiles Menü öffnet, Animationen der Startseite blenden ein.
- `/kontakt`: Testanfrage zeigt die Erfolgsmeldung; sofortiges Absenden (unter 3 Sekunden) zeigt die Fehlermeldung.
- `/kontakt/`, `/kontakt.php`, `/index.html` leiten per 301 weiter; `/includes/config.php` und `/README.md` liefern 403;
  eine unbekannte Adresse liefert die 404-Seite.
