/******/ (() => { // webpackBootstrap
/*!**********************************!*\
  !*** ./resources/js/about-us.js ***!
  \**********************************/
// Counter Animation
function animateCounter(element) {
  var target = parseInt(element.getAttribute('data-target'));
  var duration = 2000; // 2 seconds
  var step = target / (duration / 16); // 60fps
  var current = 0;
  var _updateCounter = function updateCounter() {
    current += step;
    if (current < target) {
      element.textContent = Math.floor(current);
      requestAnimationFrame(_updateCounter);
    } else {
      element.textContent = target + '+';
    }
  };
  _updateCounter();
}

// Intersection Observer for animations
var observerOptions = {
  root: null,
  rootMargin: '0px',
  threshold: 0.1
};
var observer = new IntersectionObserver(function (entries) {
  entries.forEach(function (entry) {
    if (entry.isIntersecting) {
      // Animate counters
      if (entry.target.classList.contains('counter')) {
        animateCounter(entry.target);
      }
      // Add animation classes
      entry.target.classList.add('animate-fade-in-up');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Observe elements when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
  // Observe counters
  document.querySelectorAll('.counter').forEach(function (counter) {
    observer.observe(counter);
  });

  // Observe timeline items
  document.querySelectorAll('.timeline-item').forEach(function (item) {
    observer.observe(item);
  });

  // Observe value cards
  document.querySelectorAll('.value-card').forEach(function (card) {
    observer.observe(card);
  });

  // Observe team members
  document.querySelectorAll('.team-member').forEach(function (member) {
    observer.observe(member);
  });

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      var target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
});
/******/ })()
;