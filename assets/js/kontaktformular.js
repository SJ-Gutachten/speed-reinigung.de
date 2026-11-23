/**
 * Kontaktformular: sendet die Eingaben an /kontakt-senden.php und zeigt danach
 * die Erfolgs- oder Fehlermeldung direkt im Formular an (wie zuvor bei Webflow).
 * Ohne JavaScript funktioniert das Formular weiterhin über eine normale Weiterleitung.
 */
(function () {
  var form = document.getElementById('Kontaktformular');
  if (!form || !window.fetch || !window.FormData) return;

  var wrap = form.parentNode;
  var done = wrap.querySelector('.w-form-done');
  var fail = wrap.querySelector('.w-form-fail');
  var button = form.querySelector('input[type="submit"]');
  var label = button.value;

  if (/[?&]fehler=1/.test(window.location.search)) fail.style.display = 'block';

  form.addEventListener('submit', function (event) {
    event.preventDefault();
    button.value = button.getAttribute('data-wait') || label;
    button.disabled = true;
    fail.style.display = 'none';

    fetch(form.action, { method: 'POST', body: new FormData(form), headers: { Accept: 'application/json' } })
      .then(function (response) {
        return response.json().then(function (data) {
          if (!response.ok || !data.ok) throw new Error(data.grund || 'fehler');
        });
      })
      .then(function () {
        form.style.display = 'none';
        done.style.display = 'block';
      })
      .catch(function () {
        fail.style.display = 'block';
        button.value = label;
        button.disabled = false;
      });
  });
})();
