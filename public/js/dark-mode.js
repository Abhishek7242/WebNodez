/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./resources/js/dark-mode.js ***!
  \***********************************/
// Dark mode functionality
var initDarkMode = function initDarkMode() {
  var darkModeToggle = document.getElementById('darkModeToggle');
  var icon = darkModeToggle.querySelector('i');

  // Check for saved theme preference
  var savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'dark-mode') {
    document.body.classList.add('dark-mode');
    icon.classList.remove('fa-moon');
    icon.classList.add('fa-sun');
  }

  // Toggle dark mode
  darkModeToggle.addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');

    // Update icon
    if (document.body.classList.contains('dark-mode')) {
      icon.classList.remove('fa-moon');
      icon.classList.add('fa-sun');
      localStorage.setItem('theme', 'dark-mode');
    } else {
      icon.classList.remove('fa-sun');
      icon.classList.add('fa-moon');
      localStorage.setItem('theme', 'light');
    }
  });
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initDarkMode);
/******/ })()
;