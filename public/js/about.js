/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./resources/js/about.js ***!
  \*******************************/
document.addEventListener('DOMContentLoaded', function () {
  var playground = document.querySelector('.interactive-playground');
  var floatingItems = document.querySelectorAll('.floating-item');
  var particles = document.querySelector('.particles');

  // Position floating items randomly
  floatingItems.forEach(function (item) {
    var x = Math.random() * 80 + 10;
    var y = Math.random() * 80 + 10;
    item.style.left = "".concat(x, "%");
    item.style.top = "".concat(y, "%");
  });

  // Mouse move interaction
  playground.addEventListener('mousemove', function (e) {
    var rect = playground.getBoundingClientRect();
    var x = e.clientX - rect.left;
    var y = e.clientY - rect.top;

    // Move floating items
    floatingItems.forEach(function (item) {
      var speed = item.getAttribute('data-speed');
      var itemX = (x - rect.width / 2) / speed;
      var itemY = (y - rect.height / 2) / speed;
      item.style.transform = "translate(".concat(itemX, "px, ").concat(itemY, "px)");
    });

    // Create particles
    createParticle(x, y);
  });

  // Create particle effect
  function createParticle(x, y) {
    var particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.left = x + 'px';
    particle.style.top = y + 'px';
    particles.appendChild(particle);

    // Animate particle
    var angle = Math.random() * Math.PI * 2;
    var velocity = 2 + Math.random() * 2;
    var vx = Math.cos(angle) * velocity;
    var vy = Math.sin(angle) * velocity;
    var opacity = 1;
    var _animate = function animate() {
      if (opacity <= 0) {
        particle.remove();
        return;
      }
      opacity -= 0.02;
      particle.style.opacity = opacity;
      particle.style.transform = "translate(".concat(vx, "px, ").concat(vy, "px)");
      requestAnimationFrame(_animate);
    };
    _animate();
  }

  // Click interaction
  floatingItems.forEach(function (item) {
    item.addEventListener('click', function () {
      item.style.transform = 'scale(1.2)';
      setTimeout(function () {
        item.style.transform = 'scale(1)';
      }, 200);
    });
  });
});
/******/ })()
;