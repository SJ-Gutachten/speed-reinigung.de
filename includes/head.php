<?php
/** Dokumentkopf. Erwartet $page (siehe Seiten-Dateien im Hauptverzeichnis). */
require_once __DIR__ . '/funktionen.php';
$title = e($page['title']);
$desc  = isset($page['description']) ? e($page['description']) : null;
$basis = 'https://speed-reinigung.de';
?>
<!DOCTYPE html><!-- This site was created in Webflow. https://webflow.com --><!-- Last Published: Wed May 13 2026 17:03:12 GMT+0000 (Coordinated Universal Time) --><html lang="de" data-wf-domain="speed-reinigung.de" data-wf-page="<?= e($page['wf_page']) ?>" data-wf-site="67f66454546c06874a1e8e93"><head>
<meta charset="utf-8"/>
<title><?= $title ?></title>
<?php if ($desc !== null): ?><meta content="<?= $desc ?>" name="description"/><?php endif; ?>
<meta content="<?= $title ?>" property="og:title"/>
<?php if ($desc !== null): ?><meta content="<?= $desc ?>" property="og:description"/><?php endif; ?>
<meta content="<?= $title ?>" name="twitter:title"/>
<?php if ($desc !== null): ?><meta content="<?= $desc ?>" name="twitter:description"/><meta property="og:type" content="website"/><meta content="summary_large_image" name="twitter:card"/><?php endif; ?>
<?php if (!empty($page['noindex'])): ?><meta name="robots" content="noindex"/>
<?php else: ?><link rel="canonical" href="<?= e($basis . ($page['path'] === '/' ? '/' : $page['path'])) ?>"/>
<?php endif; ?><meta property="og:image" content="<?= $basis ?>/assets/img/speed-reinigung-munchen.jpg"/>
<meta name="twitter:image" content="<?= $basis ?>/assets/img/speed-reinigung-munchen.jpg"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="Webflow" name="generator"/>
<link href="<?= e(asset('/assets/css/speed-reinigung.css')) ?>" rel="stylesheet" type="text/css"/>
<link href="<?= e(asset('/assets/css/schriften.css')) ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
<link href="/assets/img/speed-logo-32x32.png" rel="shortcut icon" type="image/x-icon"/>
<link href="/assets/img/speed-logo-256x256.png" rel="apple-touch-icon"/><!-- Meta Viewport für Mobile + Barrierefreiheit -->
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

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

<?= $page['head_extra'] ?? '' ?>
</head>
