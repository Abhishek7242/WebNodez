/******/ (() => { // webpackBootstrap
/*!***************************************!*\
  !*** ./resources/js/contactUsForm.js ***!
  \***************************************/
/******/(function () {
  // webpackBootstrap
  /*!***************************************!*\
    !*** ./resources/js/contactUsForm.js ***!
    \***************************************/
  function simulateDelayedResponse() {
    return new Promise(function (resolve) {
      setTimeout(function () {
        resolve({
          success: true,
          message: 'Simulated data received after delay'
        });
      }, 0); // Simulate a delay
    });
  }
  function displayErrors(errors, errorClass) {
    // Clear previous error messages
    console.log('Errors received:', errors);
    document.querySelectorAll(".".concat(errorClass, "-error-message")).forEach(function (errorSpan) {
      errorSpan.innerText = '';
    });

    // Loop through each error and display it near the corresponding input field
    for (var field in errors) {
      if (errors.hasOwnProperty(field)) {
        var errorSpan = document.getElementById("".concat(errorClass) + field + 'Error');
        if (errorSpan) {
          errorSpan.innerText = errors[field].join(', '); // Join multiple errors with a comma
          errorSpan.style.color = 'red';
        }
      }
    }
  }
  var inputs = document.querySelectorAll('#contact-form-container form div input');
  document.addEventListener('DOMContentLoaded', function () {
    inputs.forEach(function (input) {
      input.addEventListener('blur', function () {
        console.log(input);
        if (!input.validity.valid) {
          input.nextElementSibling.classList.add('error'); // Add error class to the next <i>
        } else {
          input.nextElementSibling.classList.remove('error'); // Remove error class if valid
        }
      });
    });
    inputs.forEach(function (input) {
      input.addEventListener('blur', function () {
        var errorTargetId = input.getAttribute('data-error-target');
        var errorIndicator = document.getElementById(errorTargetId);
        if (!input.validity.valid) {
          errorIndicator.classList.add('error'); // Add error class to the specified <i>
        } else {
          errorIndicator.classList.remove('error'); // Remove error class if valid
        }
      });
    });
  });
  var contactSubmitBtn = document.getElementById('contactSubmitBtn');
  var contactName = document.getElementById('contactName');
  var contactEmail = document.getElementById('contactEmail');
  var contactNumber = document.getElementById('contactNumber');
  var contactMessage = document.getElementById('contactMessage');
  var contactSVG = document.querySelectorAll('.input-container svg');
  var contactSpan = document.querySelectorAll('.input-container span');
  var contactI = document.querySelectorAll('.input-container i');
  var countryCode = document.getElementById('countryCode');
  contactSubmitBtn.addEventListener('click', function (e) {
    e.preventDefault();
    var img = document.createElement('img');

    // Function to simulate a delayed response

    contactSubmitBtn.classList.remove('formNotSubmitted');
    // contactSubmitBtn.classList.remove('submitForm');
    img.src = 'https://i.pinimg.com/originals/ea/b7/e1/eab7e1120c9dd628d3bb39a20a94927d.gif';
    contactSubmitBtn.innerText = '';
    contactSubmitBtn.appendChild(img);
    contactSubmitBtn.classList.add('submittingForm');

    // Display loading state or message
    console.log('Submitting form...');

    // Simulate delayed response before making actual fetch call
    simulateDelayedResponse().then(function (simulatedResponse) {
      console.log('Simulated Response:', simulatedResponse);

      // Construct options for actual fetch call
      var options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          name: contactName.value,
          email: contactEmail.value,
          number: contactNumber.value,
          countryCode: countryCode.value,
          message: contactMessage.value
        })
      };
      console.log(options);
      // Make the actual API call
      return fetch("/api/contact-us", options);
    }).then(function (response) {
      if (!response.ok) {
        return response.json().then(function (errorData) {
          throw new Error(JSON.stringify(errorData.errors));
        });
      }
      return response.json();
    }).then(function (data) {
      console.log(data);
      contactSubmitBtn.classList.remove('submittingForm');
      contactSubmitBtn.classList.add('submitFormSuccessfully');
      img.src = 'https://media.tenor.com/WsmiS-hUZkEAAAAj/verify.gif';
      contactName.value = '';
      contactEmail.value = '';
      countryCode.style.opacity = '0';
      contactNumber.value = '';
      contactMessage.value = '';
      displayErrors('', 'contact');
      for (var i = 0; i < contactSpan.length; i++) {
        contactSpan[i].removeAttribute('style');
      }
      for (var j = 0; j < contactSVG.length; j++) {
        contactSVG[j].removeAttribute('style');
      }
      contactName.removeAttribute('style');
      contactEmail.removeAttribute('style');
      contactNumber.removeAttribute('style');

      // Show feedback popup after successful submission
      setTimeout(function () {
        console.log('Attempting to show feedback popup after contact form submission...');

        // Try to show feedback popup with retries
        function attemptShowFeedbackPopup() {
          var attempts = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
          console.log('Attempting to show feedback popup (attempt ' + (attempts + 1) + ')');

          // First try the global function
          if (typeof window.showFeedbackPopup === 'function') {
            console.log('window.showFeedbackPopup function found, calling it...');
            window.showFeedbackPopup();
            return true;
          }

          // Then try the local function
          if (typeof showFeedbackPopup === 'function') {
            console.log('showFeedbackPopup function found, calling it...');
            showFeedbackPopup();
            return true;
          }

          // Finally try manual approach
          console.log('showFeedbackPopup function not found, trying manual approach...');
          var popup = document.getElementById('feedback-popup');
          if (popup) {
            console.log('Manually showing feedback popup...');
            popup.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            return true;
          } else {
            console.error('Feedback popup element not found');
            return false;
          }
        }

        // Try to show feedback popup with retries
        if (!attemptShowFeedbackPopup()) {
          // Retry after 500ms if first attempt failed
          setTimeout(function () {
            if (!attemptShowFeedbackPopup(1)) {
              // Final retry after another 500ms
              setTimeout(function () {
                attemptShowFeedbackPopup(2);
              }, 500);
            }
          }, 500);
        }
      }, 1000); // 1 second delay

      setTimeout(function () {
        contactSubmitBtn.classList.remove('submitFormSuccessfully');
        // contactSubmitBtn.classList.add('submitForm');
        contactSubmitBtn.innerText = 'Submit';
      }, 6000);
    })["catch"](function (error) {
      console.error('There was a problem with the fetch operation:', error);
      // Display error message to the user
      var errorMessages = JSON.parse(error.message);
      displayErrors(errorMessages, 'contact');
      contactSubmitBtn.innerText = 'Submit';
      // for (let i = 0; i < contactSpan.length; i++) {
      //     contactSpan[i].style.color = 'red'
      // }
      // for (let j = 0; j < contactSVG.length; j++) {
      //     contactSVG[j].style.fill = 'red'
      // }
      // inputs.forEach(function (input) {
      //     input.nextElementSibling.classList.add('error'); // Add error class to the next <i>

      // });

      contactSubmitBtn.classList.remove('submittingForm');
      contactSubmitBtn.classList.add('formNotSubmitted');
    });
  });
  var contactCheckbox = document.getElementById('contact-checkbox');
  contactCheckbox.addEventListener('click', function () {
    console.log('jjjjjjjjj');
    if (contactCheckbox.checked) {
      contactSubmitBtn.disabled = false;
      contactSubmitBtn.style.pointerEvents = 'auto';
      contactSubmitBtn.style.opacity = 1;
    } else {
      contactSubmitBtn.disabled = true;
      contactSubmitBtn.style.pointerEvents = 'none';
      contactSubmitBtn.style.opacity = 0.2;
    }
  });

  // Add focus event listener
  contactNumber.addEventListener('focus', function (event) {
    countryCode.style.opacity = '1';
  });

  // Feedback popup functionality
  document.addEventListener('DOMContentLoaded', function () {
    console.log('Contact form feedback functionality loaded');

    // Check if feedback popup element exists
    var popup = document.getElementById('feedback-popup');
    console.log('Feedback popup element found on DOMContentLoaded:', !!popup);

    // Make feedback functions globally available
    window.showFeedbackPopup = function () {
      console.log('showFeedbackPopup called from contact form');
      function showPopup() {
        var popup = document.getElementById('feedback-popup');
        if (popup) {
          console.log('Feedback popup element found, showing...');
          popup.style.display = 'flex';
          document.body.style.overflow = 'hidden';
          return true;
        } else {
          console.error('Feedback popup element not found');
          return false;
        }
      }

      // Try to show immediately
      if (!showPopup()) {
        // If not found, wait for it to be available
        var attempts = 0;
        var maxAttempts = 10;
        var checkInterval = setInterval(function () {
          attempts++;
          console.log("Checking for feedback popup (attempt ".concat(attempts, "/").concat(maxAttempts, ")"));
          if (showPopup()) {
            clearInterval(checkInterval);
          } else if (attempts >= maxAttempts) {
            console.error('Feedback popup not found after maximum attempts');
            clearInterval(checkInterval);
          }
        }, 200);
      }
    };
    window.closeFeedbackPopup = function () {
      console.log('closeFeedbackPopup called from contact form');
      var popup = document.getElementById('feedback-popup');
      if (popup) {
        popup.style.display = 'none';
        document.body.style.overflow = 'auto';
        // Reset form
        var _feedbackForm = document.getElementById('feedback-form');
        if (_feedbackForm) {
          _feedbackForm.reset();
        }
        var _ratingText = document.getElementById('rating-text');
        if (_ratingText) {
          _ratingText.textContent = 'Select your rating';
        }
      }
    };

    // Star rating functionality
    var starInputs = document.querySelectorAll('.star-input');
    var ratingText = document.getElementById('rating-text');
    if (starInputs.length > 0 && ratingText) {
      var ratingMessages = {
        1: 'Poor - We need to improve',
        2: 'Fair - Room for improvement',
        3: 'Good - Satisfactory experience',
        4: 'Very Good - Great experience',
        5: 'Excellent - Outstanding experience'
      };
      starInputs.forEach(function (input) {
        input.addEventListener('change', function () {
          var rating = this.value;
          ratingText.textContent = ratingMessages[rating];
        });
      });
    }

    // Handle feedback form submission
    var feedbackForm = document.getElementById('feedback-form');
    if (feedbackForm) {
      feedbackForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var submitBtn = this.querySelector('.feedback-submit-btn');
        var originalText = submitBtn.innerHTML;

        // Disable button and show loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

        // Send feedback to server
        fetch('/submit-feedback', {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }).then(function (response) {
          return response.json();
        }).then(function (data) {
          if (data.success) {
            // Show success message
            if (typeof Swal !== 'undefined') {
              Swal.fire({
                icon: 'success',
                title: 'Thank You!',
                text: 'Your feedback has been submitted successfully.',
                timer: 2000,
                showConfirmButton: false
              });
            } else {
              alert('Thank you! Your feedback has been submitted successfully.');
            }
            window.closeFeedbackPopup();
          } else {
            throw new Error(data.message || 'Something went wrong');
          }
        })["catch"](function (error) {
          console.error('Error:', error);
          if (typeof Swal !== 'undefined') {
            Swal.fire({
              icon: 'error',
              title: 'Oops!',
              text: 'Failed to submit feedback. Please try again.'
            });
          } else {
            alert('Failed to submit feedback. Please try again.');
          }
        })["finally"](function () {
          // Re-enable button
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        });
      });
    }

    // Close popup when clicking outside
    var overlay = document.getElementById('feedback-popup');
    if (overlay) {
      overlay.addEventListener('click', function (e) {
        if (e.target === this) {
          window.closeFeedbackPopup();
        }
      });
    }
  });

  /******/
})();
/******/ })()
;