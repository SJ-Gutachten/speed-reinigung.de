/**
 * Einwilligung für Statistik- und Marketing-Dienste.
 *
 * Ohne Zustimmung wird kein Tracking geladen und kein Cookie gesetzt. Erst nach Klick auf
 * „Zustimmen“ lädt dieses Skript den Google Tag Manager (und, falls angegeben, Google Analytics).
 * Die Entscheidung liegt 12 Monate im Browser (localStorage) und lässt sich über den Link
 * „Cookie-Einstellungen“ am Seitenende jederzeit ändern.
 *
 * Einstellungen kommen aus includes/head.php:
 *   window.EINWILLIGUNG = { gtm: 'GTM-…', ga: 'G-…', dienste: 'Text für den Hinweis' };
 */
(function () {
  var cfg = window.EINWILLIGUNG || {};
  var SCHLUESSEL = 'einwilligung';
  var GUELTIG_MS = 365 * 24 * 60 * 60 * 1000;
  var geladen = false;

  window.dataLayer = window.dataLayer || [];
  function gtag() { window.dataLayer.push(arguments); }

  // Google Consent Mode: alles verweigert, bis zugestimmt wird.
  gtag('consent', 'default', {
    ad_storage: 'denied', ad_user_data: 'denied', ad_personalization: 'denied', analytics_storage: 'denied'
  });

  function lesen() {
    try {
      var wert = JSON.parse(window.localStorage.getItem(SCHLUESSEL));
      if (wert && Date.now() - wert.zeit < GUELTIG_MS) return wert.antwort;
    } catch (e) { /* localStorage gesperrt: jedes Mal fragen */ }
    return null;
  }

  function speichern(antwort) {
    try { window.localStorage.setItem(SCHLUESSEL, JSON.stringify({ antwort: antwort, zeit: Date.now() })); } catch (e) { /* egal */ }
  }

  function skript(src) {
    var s = document.createElement('script');
    s.async = true;
    s.src = src;
    document.head.appendChild(s);
  }

  function dienste_laden() {
    if (geladen) return;
    geladen = true;
    gtag('consent', 'update', {
      ad_storage: 'granted', ad_user_data: 'granted', ad_personalization: 'granted', analytics_storage: 'granted'
    });
    if (cfg.gtm) {
      window.dataLayer.push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
      skript('https://www.googletagmanager.com/gtm.js?id=' + encodeURIComponent(cfg.gtm));
    }
    if (cfg.ga) {
      skript('https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(cfg.ga));
      gtag('js', new Date());
      gtag('config', cfg.ga);
    }
  }

  /** Bekannte Tracking-Cookies entfernen, wenn die Zustimmung widerrufen wird. */
  function cookies_loeschen() {
    var host = window.location.hostname.replace(/^www\./, '');
    document.cookie.split(';').forEach(function (c) {
      var name = c.split('=')[0].trim();
      if (!/^(_ga|_gid|_gat|_gcl|_fbp|_fbc)/.test(name)) return;
      ['', '; domain=' + host, '; domain=.' + host].forEach(function (domain) {
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/' + domain;
      });
    });
  }

  var hinweis = null;

  function schliessen() {
    if (hinweis) { hinweis.parentNode.removeChild(hinweis); hinweis = null; }
  }

  function zeigen() {
    if (hinweis) return;
    hinweis = document.createElement('div');
    hinweis.className = 'einwilligung';
    hinweis.setAttribute('role', 'dialog');
    hinweis.setAttribute('aria-label', 'Cookie-Einstellungen');
    hinweis.innerHTML =
      '<div class="einwilligung__text"><strong>Cookies und Statistik</strong>' +
      '<p>Wir möchten ' + (cfg.dienste || 'Statistik-Dienste') + ' einsetzen, um zu verstehen, wie diese Website genutzt wird. ' +
      'Dabei werden Cookies gesetzt und Daten an die Anbieter übertragen, auch in die USA. Das geschieht nur, wenn Sie zustimmen. ' +
      'Ihre Entscheidung können Sie jederzeit über „Cookie-Einstellungen“ am Seitenende ändern. ' +
      '<a href="/datenschutz">Datenschutzerklärung</a> · <a href="/impressum">Impressum</a></p></div>' +
      '<div class="einwilligung__knoepfe">' +
      '<button type="button" class="einwilligung__knopf" data-antwort="nein">Ablehnen</button>' +
      '<button type="button" class="einwilligung__knopf" data-antwort="ja">Zustimmen</button></div>';
    hinweis.addEventListener('click', function (e) {
      var antwort = e.target && e.target.getAttribute('data-antwort');
      if (!antwort) return;
      var vorher = lesen();
      speichern(antwort);
      schliessen();
      if (antwort === 'ja') {
        dienste_laden();
      } else if (vorher === 'ja' || geladen) {
        cookies_loeschen();
        window.location.reload(); // bereits geladene Dienste stoppen
      }
    });
    document.body.appendChild(hinweis);
  }

  document.addEventListener('click', function (e) {
    var link = e.target && e.target.closest && e.target.closest('[data-einwilligung-oeffnen]');
    if (!link) return;
    e.preventDefault();
    zeigen();
  });

  function start() {
    var antwort = lesen();
    if (antwort === 'ja') dienste_laden();
    else if (antwort !== 'nein') zeigen();
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
  else start();
})();
