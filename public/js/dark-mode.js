/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./resources/js/dark-mode.js ***!
  \***********************************/
var initDarkMode = function initDarkMode() {
  var toggles = [document.getElementById('darkModeToggle'), document.getElementById('darkModeMobile')];

  // Set icons based on current mode
  var updateIcons = function updateIcons(isDark) {
    toggles.forEach(function (toggle) {
      var icon = toggle.querySelector('i');
      if (isDark) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
      } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
      }
    });
  };

  // Check saved theme preference
  var savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'dark-mode') {
    document.body.classList.add('dark-mode');
    updateIcons(true);
  }

  // Toggle dark mode on click
  toggles.forEach(function (toggle) {
    toggle.addEventListener('click', function () {
      var isDark = document.body.classList.toggle('dark-mode');
      localStorage.setItem('theme', isDark ? 'dark-mode' : 'light');
      updateIcons(isDark);
    });
  });
};
document.addEventListener('DOMContentLoaded', initDarkMode);
/******/ })()
;