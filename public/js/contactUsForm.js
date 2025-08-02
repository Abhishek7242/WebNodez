/******/ (() => { // webpackBootstrap
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
      }, 5000); // Simulate a delay
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
      console.log('Contact form response:', data);
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
        console.log('Attempting to show feedback popup...');
        console.log('showFeedbackPopup function exists:', typeof showFeedbackPopup);
        console.log('window.showFeedbackPopup function exists:', typeof window.showFeedbackPopup);

        function tryShowFeedbackPopup(attempt = 1) {
          if (typeof showFeedbackPopup === 'function') {
            console.log('showFeedbackPopup function found, calling it...');
            showFeedbackPopup();
          } else if (typeof window.showFeedbackPopup === 'function') {
            console.log('window.showFeedbackPopup function found, calling it...');
            window.showFeedbackPopup();
          } else {
            console.log('showFeedbackPopup function not found, attempt:', attempt);
            console.log('Available global functions:', Object.keys(window).filter(key => key.includes('feedback')));
            // Try to manually show the popup
            const popup = document.getElementById('feedback-popup');
            if (popup) {
              console.log('Manually showing feedback popup...');
              popup.style.display = 'flex';
              document.body.style.overflow = 'hidden';
            } else {
              console.error('Feedback popup element not found');
              // Retry after a short delay if this is the first attempt
              if (attempt < 3) {
                console.log('Retrying in 500ms...');
                setTimeout(() => tryShowFeedbackPopup(attempt + 1), 500);
              }
            }
          }
        }

        tryShowFeedbackPopup();
      }, 1000); // 1 second delay

      setTimeout(function () {
        contactSubmitBtn.classList.remove('submitFormSuccessfully');
        // contactSubmitBtn.classList.add('submitForm');
        contactSubmitBtn.innerText = 'Submit';
      }, 6000);
      // Display success message to the user
      // alert('Form submitted successfully!');
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
  /******/
})()
  ;