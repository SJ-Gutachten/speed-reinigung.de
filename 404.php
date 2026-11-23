<?php
http_response_code(404);
$page = [
    'path'        => '/404',
    'title'       => 'Seite nicht gefunden',
    'wf_page'     => '',
    'webflow_js'  => 'webflow.12358f04.f0e9ff1f5864353a.js',
    'head_extra'  => '<meta name="robots" content="noindex"/>',
];
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
<div class="success">
<div class="w-container">
<div class="div-block-41 highlights">
<h2 class="success1 heading-1">Diese Seite wurde nicht gefunden.<br/><a href="/">Zur Startseite</a></h2>
</div>
</div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
