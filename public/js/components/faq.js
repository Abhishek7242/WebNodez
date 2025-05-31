/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./resources/js/components/faq.js ***!
  \****************************************/
function toggleFaq(index) {
  var answer = document.querySelectorAll('.faq-answer')[index];
  var icon = document.querySelectorAll('.faq-icon')[index];
  var question = document.querySelectorAll('.faq-question')[index];

  // Close all other answers
  document.querySelectorAll('.faq-answer').forEach(function (item, i) {
    if (i !== index) {
      item.style.maxHeight = null;
      document.querySelectorAll('.faq-icon')[i].style.transform = 'rotate(0deg)';
      document.querySelectorAll('.faq-question')[i].classList.remove('active');
    }
  });

  // Toggle current answer
  if (answer.style.maxHeight) {
    answer.style.maxHeight = null;
    icon.style.transform = 'rotate(0deg)';
    question.classList.remove('active');
  } else {
    answer.style.maxHeight = answer.scrollHeight + "px";
    icon.style.transform = 'rotate(180deg)';
    question.classList.add('active');
  }
}
/******/ })()
;