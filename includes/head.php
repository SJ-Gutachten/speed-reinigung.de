<?php
/** Dokumentkopf. Erwartet $page (siehe Seiten-Dateien im Hauptverzeichnis). */
require_once __DIR__ . '/funktionen.php';
$title = e($page['title']);
$desc  = isset($page['description']) ? e($page['description']) : null;
?>
<!DOCTYPE html><!-- This site was created in Webflow. https://webflow.com --><!-- Last Published: Wed May 13 2026 17:03:12 GMT+0000 (Coordinated Universal Time) --><html data-wf-domain="speed-reinigung.de" data-wf-page="<?= e($page['wf_page']) ?>" data-wf-site="67f66454546c06874a1e8e93"><head>
<meta charset="utf-8"/>
<title><?= $title ?></title>
<?php if ($desc !== null): ?><meta content="<?= $desc ?>" name="description"/><?php endif; ?>
<meta content="<?= $title ?>" property="og:title"/>
<?php if ($desc !== null): ?><meta content="<?= $desc ?>" property="og:description"/><?php endif; ?>
<meta content="<?= $title ?>" name="twitter:title"/>
<?php if ($desc !== null): ?><meta content="<?= $desc ?>" name="twitter:description"/><meta property="og:type" content="website"/><meta content="summary_large_image" name="twitter:card"/><?php endif; ?>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="Webflow" name="generator"/>
<link href="/assets/css/speed-reinigung.css" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous"/>
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
<script type="text/javascript">WebFont.load({  google: {    families: ["Exo:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","Droid Sans:400,700","Ubuntu:300,300italic,400,400italic,500,500italic,700,700italic","Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Archivo Narrow:300,400,500,600,700","Cabin:300,400,500,600,700","Libre Franklin:300,400,500,600,700","Londrina Shadow:300,400,500,600,700","Londrina Solid:300,400,500,600,700","Padauk:300,400,500,600,700","Roboto:300,400,500,600,700","Rubik:300,400,500,600,700","Staatliches:300,400,500,600,700"]  }});</script>
<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
<link href="/assets/img/speed-logo-32x32.png" rel="shortcut icon" type="image/x-icon"/>
<link href="/assets/img/speed-logo-256x256.png" rel="apple-touch-icon"/><!-- Meta Viewport für Mobile + Barrierefreiheit -->
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

<!-- Preconnect für Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Google Fonts mit font-display:swap -->
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<!-- Basis CSS für mobiles Verhalten -->
<style>
  html, body {
    overflow-x: hidden;
    max-width: 100vw;
    overscroll-behavior-x: none;
    touch-action: pan-y;
    margin: 0;
    position: relative;
  }

  img, video {
    max-width: 100%;
    height: auto;
    display: block;
  }
</style>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N2C3F57M');</script>
<!-- End Google Tag Manager -->

<!-- ConsentManager Script (verzögert für bessere Performance) -->
<script>
  window.addEventListener("DOMContentLoaded", function () {
    var cmpScript = document.createElement("script");
    cmpScript.src = "https://cdn.consentmanager.net/delivery/cmp_en.min.js";
    cmpScript.async = true;
    document.body.appendChild(cmpScript);
  });
</script>
<?= $page['head_extra'] ?? '' ?>
</head>
