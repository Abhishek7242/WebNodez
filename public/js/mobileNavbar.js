/******/ (() => { // webpackBootstrap
/*!**************************************!*\
  !*** ./resources/js/mobileNavbar.js ***!
  \**************************************/
// MOBILE NAVBAR
var hamIcon = document.getElementById('ham-icon');
var mobileNav = document.getElementById('mobile-nav');
var navItems = document.querySelectorAll('#mobile-nav .nav-btns');
hamIcon.addEventListener('click', function () {
  mobileNav.classList.add('show');
});
hamIcon.addEventListener('click', function () {
  if (!show) {
    document.body.classList.add('no-scroll');
    show = true;
    mobileNav.style.right = '0px';
    navItems.forEach(function (item, index) {
      setTimeout(function () {
        item.classList.add('animate');
      }, index * 200); // Adjust the delay as needed
    });
  } else {
    show = false;
    navItems.forEach(function (item, index) {
      setTimeout(function () {
        item.classList.remove('animate');
      }, index * 100); // Adjust the delay as needed
    });
    setTimeout(function () {
      document.body.classList.remove('no-scroll');
      hamIcon.style.opacity = "1";
      mobileNav.classList.remove('show');
      setTimeout(function () {
        mobileNav.style.right = '-1000px';
      }, 600);
    }, 1100);
  }

  // Trigger the mobileNav animation after the last li animation
});
/******/ })()
;