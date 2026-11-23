# Analyse: speed-reinigung.de (Webflow-Stand vom 13.05.2026)

Bestandsaufnahme der bei Webflow veröffentlichten Website vor dem Umzug zu Hostinger.
Erhoben am 23.11.2026 über den Webflow-Connector (nur lesend) und die veröffentlichte Seite.
Der unveränderte Originalstand liegt im ersten Commit auf `main` („Webflow-Export (Original)“).

## 1. Herkunft der Daten und Vollständigkeit

| Quelle | Liefert | Liefert nicht |
|---|---|---|
| Webflow-Connector | Seitenliste mit SEO-Titeln und Descriptions, Formulardefinition, Custom Code (Head/Footer), Asset-Liste (69 Dateien, 21,8 MB), CMS-Collections (keine vorhanden) | HTML, CSS und JavaScript der Seiten – ein Code-Export ist über den Connector nicht möglich |
| Veröffentlichte Seite | HTML aller 8 Seiten, 1 CSS-Datei, jQuery und webflow.js (5 Dateien), 74 Bilder | Inhalte, die im Designer geändert, aber nicht veröffentlicht wurden |

Der Stand ist vollständig genug, um die Seite 1:1 nachzubauen; die Export-ZIP aus dem Designer wurde nicht benötigt.

Zwei Einschränkungen:

- **Unveröffentlichte Änderungen:** Webflow meldet „zuletzt geändert 23.11.2026“, veröffentlicht wurde zuletzt am 13.05.2026. Falls im Designer seit Mai etwas geändert und nicht veröffentlicht wurde, fehlt es hier.
- **Nicht verwendete Assets:** Von den 69 Dateien in der Webflow-Mediathek verwendet die Live-Seite nur einen Teil. Drei Videos (MP4, zusammen ca. 8 MB) und mehrere Stockfotos sind auf keiner Seite eingebunden und wurden nicht übernommen. Sie liegen weiter in der Webflow-Mediathek.

## 2. Seiten

Alle Adressen unter `https://speed-reinigung.de` (ohne `www`).

| URL | Titel | Meta-Description | In Sitemap |
|---|---|---|---|
| `/` | Speed-Reinigung München – Gebäudereinigung & Büroservice vom Profi | Speed-Reinigung München bietet schnelle, zuverlässige und professionelle Reinigungsdienste für Privat und Gewerbe. Jetzt unverbindliches Angebot für Büro-, Praxis- & Gebäudereinigung anfordern! | ja |
| `/leistungen` | Leistungen der Speed-Reinigung München \| Büro, Praxis, Gebäudereinigung & mehr | Entdecken Sie die professionellen Reinigungsleistungen von Speed-Reinigung München: Büroreinigung, Praxisreinigung, Gebäudereinigung, Fenster- und Teppichreinigung – schnell, gründlich & zuverlässig. Jetzt Beratung sichern! | ja |
| `/galerie` | Galerie Speed-Reinigung München \| Professionelle Reinigungsarbeiten & Ergebnisse | Entdecken Sie die beeindruckenden Vorher-Nachher-Bilder unserer Reinigungsprofis in München. Speed-Reinigung zeigt Ihnen professionelle Sauberkeit bei Büro-, Wohn- & Bauendreinigung. Jetzt ansehen! | ja |
| `/kontakt` | Kontakt Speed-Reinigung München \| Zuverlässige Reinigungsfirma – Jetzt Angebot anfragen | Speed-Reinigung – Ihre professionelle Reinigungsfirma in München. Büro-, Praxis- & Privatreinigung schnell & zuverlässig. Kontaktieren Sie uns für ein kostenloses Angebot! | ja |
| `/impressum` | Impressum | – (keine) | ja |
| `/datenschutz` | Datenschutz | – (keine) | ja |
| `/success` | Success | – (keine) | ja |
| `/401` | Protected page | – (keine) | nein |
| (jede unbekannte Adresse) | 404 - Page not found | Webflow-Standardseite, englisch | – |

## 3. CMS-Collections

Keine. Die Website besteht ausschließlich aus statischen Seiten; es gibt weder Collections noch Collection-Listen oder Template-Seiten.

## 4. Was ohne Webflow-Hosting nicht mehr läuft

| Funktion | Bisher | Nach dem Umzug |
|---|---|---|
| **Kontaktformular** (`/kontakt`) | Felder Vorname, Nachname, E-Mail (Pflicht), Nachricht, Datenschutz-Checkbox (Pflicht). webflow.js schickt die Daten an Webflow; Webflow speichert sie und versendet die Benachrichtigung. Erfolgs- und Fehlermeldung erscheinen im Formular. | Eigener PHP-Handler `kontakt-senden.php` mit Spamschutz. An welche Adresse Webflow die Benachrichtigungen bisher geschickt hat, ist über den Connector nicht auslesbar – voreingestellt ist `info@speed-reinigung.de`. |
| **Bisherige Formular-Einsendungen** | In Webflow gespeichert | Bleiben bei Webflow. Vor einer Kündigung dort bei Bedarf exportieren. |
| **Passwortschutz** (`/401`) | Webflow-Seite „Protected page“ mit Formular an `/.wf_auth` | Entfällt. Keine Seite der Website ist passwortgeschützt; die Seite war nur das Webflow-Standardgerüst. |
| **Suche** | nicht vorhanden | – |
| **404-Seite** | englische Webflow-Standardseite | Eigene Seite `404.php` im Design der Website |
| **Sitemap / robots.txt** | von Webflow erzeugt | Statische Dateien `sitemap.xml` und `robots.txt` (Inhalt unverändert) |
| **Bilder-CDN** | `cdn.prod.website-files.com` (Webflow) | Bilder liegen lokal unter `assets/img` |
| **Weiterleitungen** | `http → https`, `www → ohne www`, `/seite/ → /seite` durch Webflow | Gleiches Verhalten über `.htaccess` |

## 5. Externe Skripte, Tracking, Einbettungen

| Dienst | Wo | Einbindung | Anmerkung |
|---|---|---|---|
| Google Tag Manager `GTM-N2C3F57M` | alle Seiten | Custom Code im Head | Lädt sofort, ohne Einwilligung abzuwarten. Im Test wurde ein Facebook-Pixel-Cookie (`_fbp`) gesetzt, bevor irgendeine Zustimmung erfolgt ist. |
| consentmanager.net | alle Seiten | `cmp_en.min.js`, nach dem Laden der Seite nachgeladen | Das Skript wird ohne Konto-Kennung eingebunden. Im Test erschien **kein Cookie-Banner**. |
| Google Fonts | alle Seiten | `webfont.js` von `ajax.googleapis.com`, Schriften von `fonts.googleapis.com` / `fonts.gstatic.com`; zusätzlich Roboto per `<link>` | 13 Schriftfamilien mit allen Schnitten (siehe Abschnitt 7) |
| YouTube (über Embedly) | Startseite | `<iframe>` von `cdn.embedly.com`, Video `lqxQHXDaUCY` | Lädt sofort beim Seitenaufruf |
| Elfsight | Startseite, Abschnitt „Kundenservice & Kontakt“ | `apps.elfsight.com/p/platform.js`, Widget `6ed86dbf-e325-4bad-baae-cb1ef32849b4` | Zeigt die Zähler Flexibilität / Zuverlässigkeit / Sauberkeit. Funktioniert unabhängig vom Hoster. |
| Google Maps | Footer, Kontakt | nur Link auf `maps.app.goo.gl`, Karte ist ein Bild | kein eingebettetes Maps-Skript |
| jQuery 3.5.1 | alle Seiten | von `d3e54v103j8qbb.cloudfront.net` (Webflow) | jetzt lokal |
| `platzhalterabcd.de/customerpreview/saveToken.js` | nur `/401` | Skript-Einbindung | Die Domain ist nicht erreichbar. Entfällt zusammen mit der 401-Seite. |

Die Datenschutzerklärung nennt Google Fonts, Adobe Fonts und consentmanager. **Nicht geändert**, aber zu prüfen: Sie sollte zu den tatsächlich eingesetzten Diensten passen (Google Tag Manager, Facebook-Pixel, YouTube/Embedly, Elfsight; Adobe Fonts wird nicht verwendet) und den Hosting-Anbieter nennen (bisher Webflow, künftig Hostinger).

## 6. Abhängigkeiten von webflow.js

webflow.js (rund 215 KB in drei Dateien) und jQuery (87 KB) werden für Folgendes gebraucht:

| Funktion | Wo | Hinweis |
|---|---|---|
| Mobile Navigation (Hamburger-Menü, `w-nav`) | alle Seiten | ab 991 px Breite und darunter |
| Einblend-Animationen (Interactions, `data-w-id`) | Startseite (8 Elemente, 6 starten unsichtbar mit `opacity:0`), Leistungen (10, Hover-Effekte der Kacheln), übrige Seiten 1–2 | Ohne webflow.js blieben sechs Bereiche der Startseite unsichtbar. Die Animationen hängen an der Seiten-ID `data-wf-page` im `<html>`-Tag. |
| Lightbox (`w-lightbox`) | Galerie, 12 Bilder | Im Original ohne Funktion: Die Bildlisten der Lightbox sind leer, ein Klick öffnet nichts. |
| Formular (`w-form`) | Kontakt | Versand lief über webflow.js an Webflow; jetzt durch `assets/js/kontaktformular.js` ersetzt |
| Slider, Tabs, Dropdowns, Hintergrundvideo | – | nicht verwendet |

Die drei webflow.js-Dateien wurden unverändert übernommen. Pro Seite wird eine von drei Varianten der dritten Datei geladen (Standard, Galerie, Kontakt).

## 7. Ungenutztes, Dateigrößen

**Schriften.** Geladen werden 13 Familien (Exo, Droid Sans, Ubuntu, Open Sans, Archivo Narrow, Cabin, Libre Franklin, Londrina Shadow, Londrina Solid, Padauk, Roboto, Rubik, Staatliches) mit zusammen über 80 Schnitten. Das CSS verwendet davon 8. Archivo Narrow, Libre Franklin, Londrina Shadow, Padauk und Rubik werden nirgends benutzt. Umgekehrt verlangt das CSS „Londrina Sketch“ (große Überschrift „Home“ auf der Startseite), diese Schrift wird aber nicht geladen.

**CSS.** Eine Datei, 72 KB. Von 162 eigenen Klassen kommen 39 auf keiner Seite vor (z. B. `footer-2`, `navbar-6`, `google-maps`, `terminbutton`, `ablaufplan`). Dazu 195 Webflow-Standardklassen (`w-…`), von denen nur ein kleiner Teil gebraucht wird (kein Slider, keine Tabs, kein Shop).

**JavaScript.** Rund 300 KB (jQuery + webflow.js) für Menü und Einblendungen.

**Custom Code.** Im Footer steht eine Funktion `loadYT` für nachladbare YouTube-Videos samt auskommentiertem Beispiel; sie wird nirgends aufgerufen. Im Head wird der Viewport zweimal gesetzt.

**Bilder.** 74 Dateien, 6,4 MB. Auffällig:

| Datei (neu) | Größe | Anmerkung |
|---|---|---|
| `karte-standort.png` | 695 KB | Kartenbild als PNG, 1350 px breit, angezeigt mit höchstens 648 px. Steht im Footer jeder Seite. |
| `speed-reinigung-munchen.jpg` | 373 KB | Hintergrundbild aus dem CSS |
| `galerie-01.jpg` … `galerie-13.jpg` | je 170–280 KB | Galerie zeigt 12 Bilder; kleinere Varianten (`-p-500`, `-p-800`) sind vorhanden |
| `logo-speed-reinigung.png` | 1546 px breit | angezeigt mit 200 px; kleinere Varianten vorhanden |

## 8. SEO

- **`<html lang>` fehlt** auf allen Seiten.
- **Kein Canonical-Tag**, kein `og:image` auf allen Seiten.
- **Überschriften:** Startseite hat fünf `<h1>` (darunter „Home“, „01“, „02“, „03“). Kontakt, Leistungen und Success haben gar keine `<h1>`. Auf Leistungen beginnt die Hierarchie bei `<h3>`.
- **Strukturierte Daten auf `/kontakt` enthalten Platzhalter:** Adresse „Deine Straße 12, 80331 München“ und Telefon „+49 89 1234567“ statt Zietenstraße 8, 80807 München und +49 178 5755641. Das Logo `https://www.speed-reinigung.de/logo.png` existiert nicht (404).
- **`/success` steht in der Sitemap** und ist indexierbar; ebenso fehlen bei Impressum, Datenschutz und Success die Meta-Descriptions.
- **Titel „Success“** ist englisch.
- **Versteckter Textblock** auf der Startseite (Klasse `hide`, ca. 700 Zeichen), der den sichtbaren Absatz darüber weitgehend wiederholt.
- **Textfehler** (nicht geändert): „gal ob kleines Büro …“ (fehlendes „E“), „anderen Stödte“, Alt-Texte „Häckchen-Icon“ / „Päckchen-Icon“, Videotitel „Gebädereinigung“.
- **Kaputter Link auf `/kontakt`:** Das Kartenbild oben verlinkt auf `#https://maps.app.goo.gl/WwFBiemoFX28hjAN7` – wegen des `#` führt der Klick nirgendwohin.

## 9. Barrierefreiheit

- Keine Sprachangabe (`lang`), siehe oben.
- Logo im Seitenkopf ohne Alt-Text und ohne Link zur Startseite.
- 42 von 69 Bildern haben einen leeren Alt-Text, darunter inhaltlich relevante (Leistungs-Icons, Karte).
- Hamburger-Menü-Schaltfläche ist ein `<div>` ohne beschriftenden Text.
- Galerie: 12 Links mit `href="#"` ohne Funktion (siehe Lightbox).
- Im Formular hat die Checkbox-Beschriftung ein `for`-Attribut an einem `<span>` (wirkungslos; die Zuordnung funktioniert trotzdem über das umschließende `<label>`).
- Bilder ohne `width`/`height` im HTML (67 von 69); ein Skript im Footer trägt die Werte erst nach dem Laden nach, was Layout-Sprünge nicht verhindert.

## 10. Bisherige URLs und Weiterleitungen

Diese Adressen müssen nach dem Umzug weiter funktionieren. Im Umbau bleiben alle unverändert erreichbar, es sind **keine 301-Weiterleitungen auf neue Adressen nötig**.

| Bisherige URL | Status bisher | Nach dem Umzug |
|---|---|---|
| `/` | 200 | 200 (`index.php`) |
| `/leistungen` | 200 | 200 (`leistungen.php`) |
| `/galerie` | 200 | 200 (`galerie.php`) |
| `/kontakt` | 200 | 200 (`kontakt.php`) |
| `/impressum` | 200 | 200 (`impressum.php`) |
| `/datenschutz` | 200 | 200 (`datenschutz.php`) |
| `/success` | 200 | 200 (`success.php`) |
| `/401` | 200 | 404 (Seite entfällt, war nie verlinkt) |
| `/sitemap.xml`, `/robots.txt` | 200 | 200 |
| `/index.html` | 200 (Kopie der Startseite) | 301 → `/` |
| `/kontakt/` (mit Schrägstrich) | 301 → `/kontakt` | 301 → `/kontakt` |
| `/kontakt.html` | 404 | 301 → `/kontakt` |
| `http://…` | 301 → `https://…` | 301 → `https://…` |
| `www.speed-reinigung.de/…` | 301 → `speed-reinigung.de/…` | 301 → `speed-reinigung.de/…` |

Bild-Adressen lagen bisher auf dem Webflow-CDN (`cdn.prod.website-files.com/67f66454546c06874a1e8e93/…`), nicht auf der eigenen Domain. Dafür sind keine Weiterleitungen möglich oder nötig; Treffer in der Google-Bildersuche werden neu erfasst.

## 11. DNS-Ist-Zustand (23.11.2026, nur gelesen)

| Eintrag | Wert | Bedeutung |
|---|---|---|
| NS | `ns5.kasserver.com`, `ns6.kasserver.com` | DNS wird bei All-Inkl verwaltet |
| A `speed-reinigung.de` | `198.202.211.1` | Webflow |
| CNAME `www` | `proxy-ssl.webflow.com` | Webflow |
| MX | `w02011ed.kasserver.com` (Priorität 10) | E-Mail bei All-Inkl – **bleibt unverändert** |
| TXT (SPF) | `v=spf1 a mx include:spf.kasserver.com ~all` | **bleibt unverändert** |
| TXT `_dmarc` | `v=DMARC1; p=none;` | **bleibt unverändert** |
| TXT | `google-site-verification=…` | Google Search Console, bleibt |

Für den Umzug müssen nur der A-Eintrag der Hauptdomain und der Eintrag für `www` geändert werden. Ein DKIM-Eintrag wurde unter den üblichen Namen nicht gefunden.

Folge für das Kontaktformular: Die Website verschickt die Benachrichtigung künftig vom Hostinger-Server. Der SPF-Eintrag erlaubt über das `a` den Server, auf den die Domain zeigt. Ob Hostinger tatsächlich von dieser Adresse aus sendet, muss auf der temporären Adresse bzw. nach der Umstellung mit einer Testanfrage geprüft werden.
