/*!
* Start Bootstrap - Landing Page v6.0.6 (https://startbootstrap.com/theme/landing-page)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-landing-page/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project
function validateTimeInput(inputElement) {
  var inputValue = inputElement.value;
  if (!/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/.test(inputValue)) {
    // Format waktu tidak sesuai, hapus karakter terakhir
    inputElement.value = inputValue.slice(0, -1);
  }
}

document.getElementById('jam_mulai').addEventListener('input', function (event) {
  validateTimeInput(event.target);
});

document.getElementById('jam_selesai').addEventListener('input', function (event) {
  validateTimeInput(event.target);
});