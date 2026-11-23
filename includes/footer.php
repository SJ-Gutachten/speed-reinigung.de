<?php /** Fußbereich (Kontaktblock), Skripte und Dokumentende (auf allen Seiten gleich). */ ?>
<section class="hauptfarbe">
<div data-w-id="604627ca-7d0d-d3c8-5037-58c9365eff64" class="w-layout-grid grid-5">
<div class="content1">
<h3 class="heading2 heading-2">Kontaktier uns<br/></h3>
<div class="w-layout-grid grid-6">
<div id="w-node-_604627ca-7d0d-d3c8-5037-58c9365eff6b-365eff63" class="content_block">
<div class="relative"><img width="0" height="0" src="/assets/img/icon-telefon.avif" loading="lazy" alt="" class="icon small"/>
</div>
<h4 class="heading1 heading-2">Telefon &amp; Mail</h4><a href="tel:+491785755641" class="link-block w-inline-block">
<p class="paragraph_links flie-text klein">Telefon: +491785755641<br/></p></a><a href="mailto:info@speed-reinigung.de" class="link-block w-inline-block">
<p class="paragraph_links flie-text klein">E-Mail: info@speed-reinigung.de<br/></p></a>
</div>
<div id="w-node-_604627ca-7d0d-d3c8-5037-58c9365eff72-365eff63" class="content_block">
<div class="relative"><img width="0" height="0" src="/assets/img/icon-standort.avif" loading="lazy" alt="" class="icon small"/>
</div>
<h4 class="heading1 heading-2">Adresse</h4>
<p class="paragraph_links flie-text klein">Zietenstraße 8<br/>80807 München<br/></p>
</div>
<div class="content_block">
<div class="relative"><img width="0" height="0" src="/assets/img/icon-email.avif" loading="lazy" alt="" class="icon small"/>
</div>
<h4 class="heading1 heading-2">Sonstiges</h4>
<p class="paragraph_links flie-text klein"><a <?= nav_attrs('/impressum', 'impressum flie-text') ?>>Impressum<br/></a><a <?= nav_attrs('/datenschutz', 'datenschutz flie-text') ?>>Datenschutz</a></p>
</div>
<div id="w-node-_94df2824-8f87-4dd7-29a1-880b360c01c6-365eff63" class="content_block oben"><a href="https://maps.app.goo.gl/o6hiAG5ged6Q4JpJ6" target="_blank" class="w-inline-block"><img src="/assets/img/karte-standort.webp" loading="lazy" sizes="(max-width: 479px) 100vw, 648px" srcset="/assets/img/karte-standort-p-500.webp 500w, /assets/img/karte-standort-p-800.webp 800w, /assets/img/karte-standort-p-1080.webp 1080w, /assets/img/karte-standort.webp 1350w" alt="Karte mit dem Standort Zietenstraße 8, 80807 München" class="image"/></a>
</div>
</div>
</div>
</div>
</section>
<script src="/assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="/assets/js/webflow.schunk.36b8fb49256177c8.js" type="text/javascript"></script>
<script src="/assets/js/webflow.schunk.a8ae3bd3d5845114.js" type="text/javascript"></script>
<script src="/assets/js/<?= e($page['webflow_js']) ?>" type="text/javascript"></script>


<!-- Passive Touch Listener für bessere Scroll-Performance -->
<script>
  window.addEventListener("touchstart", () => {}, { passive: true });
</script>

<!-- Fix für Lazy-Images ohne feste Größe (verhindert Layout Shift) -->
<script>
  window.addEventListener("load", () => {
    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
      if (!img.hasAttribute('width')) img.setAttribute('width', img.naturalWidth || 300);
      if (!img.hasAttribute('height')) img.setAttribute('height', img.naturalHeight || 200);
    });
  });
</script>
<?php foreach ($page['scripts'] ?? [] as $src): ?><script src="<?= e($src) ?>" defer></script>
<?php endforeach; ?></body></html>
