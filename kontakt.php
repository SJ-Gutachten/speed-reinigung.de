<?php
$page = [
    'path'        => '/kontakt',
    'title'       => 'Kontakt Speed-Reinigung München | Zuverlässige Reinigungsfirma – Jetzt Angebot anfragen',
    'description' => 'Speed-Reinigung – Ihre professionelle Reinigungsfirma in München. Büro-, Praxis- & Privatreinigung schnell & zuverlässig. Kontaktieren Sie uns für ein kostenloses Angebot!',
    'wf_page'     => '67f66454546c06874a1e8e9b',   // Webflow-Seiten-ID, steuert die Animationen in webflow.js
    'webflow_js'  => 'webflow.39a63413.dcaaee9546da071f.js',
    'head_extra'  => <<<'HTML'
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CleaningService",
  "name": "Speed-Reinigung",
  "image": "https://speed-reinigung.de/assets/img/speed-logo-256x256.png",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Zietenstraße 8",
    "addressLocality": "München",
    "postalCode": "80807",
    "addressCountry": "DE"
  },
  "telephone": "+491785755641",
  "email": "info@speed-reinigung.de",
  "url": "https://speed-reinigung.de/",
  "areaServed": "München"
}
</script>
HTML,
    'scripts'     => ['/assets/js/kontaktformular.js'],
];
header('Cache-Control: no-store'); // das Formular enthält ein zeitgebundenes Token
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<div class="section4">
<section class="section-kontakt">
<h1 class="wie-h2">Kontaktieren Sie Speed-Reinigung – Ihre Reinigungsfirma in München</h1>
</section>
<div class="w-layout-grid grid-4">
<div class="content_block oben"><a href="https://maps.app.goo.gl/o6hiAG5ged6Q4JpJ6" target="_blank" class="w-inline-block"><img src="/assets/img/karte-standort.webp" loading="lazy" width="598" height="Auto" alt="Karte mit dem Standort Zietenstraße 8, 80807 München" srcset="/assets/img/karte-standort-p-500.webp 500w, /assets/img/karte-standort-p-800.webp 800w, /assets/img/karte-standort-p-1080.webp 1080w, /assets/img/karte-standort.webp 1350w" sizes="(max-width: 479px) 100vw, 598px"/></a>
</div>
<div class="form-wrap">
<div class="form1 w-form">
<div class="heading1 heading-2 w-inline-block">Senden Sie uns eine Nachricht!</div>
<form id="Kontaktformular" name="wf-form-Kontaktformular" data-name="Kontaktformular" method="post" action="/kontakt-senden.php" class="contact-form">
<?php /* Spamschutz: verstecktes Feld (muss leer bleiben) und Zeitstempel-Token, siehe kontakt-senden.php */ ?>
<div aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden"><label for="website">Bitte dieses Feld leer lassen</label><input type="text" name="website" id="website" tabindex="-1" autocomplete="off"/></div><input type="hidden" name="_ts" value="<?= e(form_token()) ?>"/>
<div class="w-layout-grid form-grid">
<div class="div-block-149"><label for="Vorname" class="flie-text">Vorname</label><input class="text-field-4 w-input" maxlength="256" name="Vorname" data-name="Vorname:" placeholder="" type="text" id="Vorname" required=""/>
</div>
<div class="div-block-149"><label for="Nachname" class="flie-text">Nachname</label><input class="text-field-4 w-input" maxlength="256" name="Nachname" data-name="Nachname:" placeholder="" type="text" id="Nachname" required=""/>
</div>
</div><label for="email" class="flie-text">E-Mail </label><input class="text-field-4 w-input" maxlength="256" name="E-Mail" data-name="E Mail:" placeholder="" type="email" id="email" required=""/><label for="Ihre-Nachricht" class="flie-text">Ihre Nachricht</label>
<textarea id="Ihre-Nachricht" name="Ihre-Nachricht" maxlength="5000" data-name="Ihre Nachricht:" placeholder="" class="text-field-4 cc-textarea w-input"></textarea><label class="w-checkbox checkbox-field-2"><input type="checkbox" name="Datenschutzzustimmung" id="Datenschutzzustimmung" data-name="Datenschutzzustimmung:" required="" class="w-checkbox-input checkbox-2"/><span for="Datenschutzzustimmung" class="form-text flie-text w-form-label">*Ich habe die <a href="/datenschutz" class="link-formular farbe-der-headings">Datenschutzerklärung</a> zur Kenntnis genommen.<br/>Ich stimme zu, dass meine Angaben zur Kontaktaufnahme und für Rückfragen dauerhaft gespeichert werden.</span></label><input type="submit" data-wait="Einen Moment bitte..." data-w-id="005aff3e-ceed-dbfa-9558-151bddbb7eba" class="submit-button1 highlights flie-text w-button" value="Senden"/>
</form>
<div class="contact-form-success-message w-form-done"><img src="/assets/img/success-icon-dark.png" width="30" alt="" class="contact-form-success-icon"/>
<div><strong>Vielen Dank für Ihre Anfrage ! Wir werden uns innerhalb von 24 Stunden bei Ihnen melden.</strong>
</div>
</div>
<div class="error-message w-form-fail">
<div>Einige oder ein Feld ist fehlerhaft. Bitte überprüfen Sie ihre Angaben.</div>
</div>
</div>
</div>
</div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
