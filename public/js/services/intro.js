/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./resources/js/services/intro.js ***!
  \****************************************/
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
document.addEventListener('DOMContentLoaded', function () {
  var playground = document.querySelector('.services-playground');
  var serviceNames = document.querySelectorAll('.services-name');
  var floatingIcons = document.querySelectorAll('.services-icon');
  var elements = [].concat(_toConsumableArray(serviceNames), _toConsumableArray(floatingIcons));

  // Set initial positions in a circle
  elements.forEach(function (element, index) {
    var angle = index * (360 / elements.length) * (Math.PI / 180);
    var radius = 120;
    var x = Math.cos(angle) * radius;
    var y = Math.sin(angle) * radius;
    element.style.transform = "translate(calc(-50% + ".concat(x, "px), calc(-50% + ").concat(y, "px))");
  });
  var mouseX = 0;
  var mouseY = 0;
  var centerX = 0;
  var centerY = 0;

  // Update center position on resize
  function updateCenter() {
    var rect = playground.getBoundingClientRect();
    centerX = rect.width / 2;
    centerY = rect.height / 2;
  }
  updateCenter();
  window.addEventListener('resize', updateCenter);

  // Mouse move effect
  playground.addEventListener('mousemove', function (e) {
    var rect = playground.getBoundingClientRect();
    mouseX = e.clientX - rect.left;
    mouseY = e.clientY - rect.top;

    // Calculate mouse position relative to center
    var deltaX = mouseX - centerX;
    var deltaY = mouseY - centerY;
    elements.forEach(function (element, index) {
      var angle = index * (360 / elements.length) * (Math.PI / 180);
      var radius = 120;

      // Calculate base position
      var baseX = Math.cos(angle) * radius;
      var baseY = Math.sin(angle) * radius;

      // Add mouse influence
      var influenceX = deltaX * 0.2;
      var influenceY = deltaY * 0.2;

      // Apply movement with smooth transition
      element.style.transform = "translate(calc(-50% + ".concat(baseX + influenceX, "px), calc(-50% + ").concat(baseY + influenceY, "px))");
    });
  });

  // Reset positions when mouse leaves
  playground.addEventListener('mouseleave', function () {
    elements.forEach(function (element, index) {
      var angle = index * (360 / elements.length) * (Math.PI / 180);
      var radius = 120;
      var x = Math.cos(angle) * radius;
      var y = Math.sin(angle) * radius;
      element.style.transform = "translate(calc(-50% + ".concat(x, "px), calc(-50% + ").concat(y, "px))");
    });
  });

  // Add hover effect for icons
  floatingIcons.forEach(function (icon) {
    icon.addEventListener('mouseenter', function () {
      icon.style.zIndex = '3';
    });
    icon.addEventListener('mouseleave', function () {
      icon.style.zIndex = '1';
    });
  });
});
/******/ })()
;