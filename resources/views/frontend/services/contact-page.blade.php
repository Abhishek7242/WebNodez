<section id="contact"
    class="contact-page-section py-16 md:py-20 px-4 md:px-12 lg:px-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="contact-page-container max-w-4xl mx-auto">
        <!-- Section Header -->
        <div class="contact-page-header text-center mb-12 md:mb-16">
            <div class="contact-page-badge flex items-center justify-center space-x-3 mb-4 md:mb-6">
                <div class="contact-page-badge-line w-2 h-6 md:h-8 rounded-full"></div>
                <span class="contact-page-badge-text font-medium text-sm md:text-lg">Get in Touch</span>
            </div>
            <h2 class="contact-page-title text-2xl md:text-4xl lg:text-5xl font-bold mb-4 md:mb-6">Contact Us</h2>
            <p class="contact-page-description text-base md:text-xl text-gray-600">
                Have a question or want to work together? We'd love to hear from you.
            </p>
        </div>

        <!-- Contact Form -->
        <div class="contact-page-form-container bg-white rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-12">
            <form class="contact-page-form space-y-4 md:space-y-6" id="contactForm">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <!-- Name Field -->
                    <div class="contact-page-form-group">
                        <div class="contact-page-input-wrapper">
                            <input type="text" id="name" name="name"
                                class="contact-page-input w-full px-3 md:px-4 py-2.5 md:py-3.5 rounded-lg md:rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300 text-sm md:text-base"
                                placeholder="Your Name" required>
                            <div class="error-message text-red-500 text-sm mt-1" id="nameError"></div>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="contact-page-form-group">
                        <div class="contact-page-input-wrapper">
                            <input type="email" id="email" name="email"
                                class="contact-page-input w-full px-3 md:px-4 py-2.5 md:py-3.5 rounded-lg md:rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300 text-sm md:text-base"
                                placeholder="Your Email" required>
                            <div class="error-message text-red-500 text-sm mt-1" id="emailError"></div>
                        </div>
                    </div>
                </div>

                <!-- Phone Field (Optional) -->
                <div class="contact-page-form-group">
                    <div class="contact-page-input-wrapper">
                        <input pattern="\d{10}" autocomplete="tel" maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)" type="number"
                            id="phone" name="number"
                            class="contact-page-input w-full px-3 md:px-4 py-2.5 md:py-3.5 rounded-lg md:rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300 text-sm md:text-base"
                            placeholder="Phone Number (Optional)">
                        <div class="error-message text-red-500 text-sm mt-1" id="phoneError"></div>
                    </div>
                </div>

                <!-- Message Field -->
                <div class="contact-page-form-group">
                    <div class="contact-page-input-wrapper">
                        <textarea id="message" name="message" rows="4"
                            class="contact-page-input w-full px-3 md:px-4 py-2.5 md:py-3.5 rounded-lg md:rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300 resize-none text-sm md:text-base"
                            placeholder="Your Message" required></textarea>
                        <div class="error-message text-red-500 text-sm mt-1" id="messageError"></div>
                    </div>
                </div>
                {!! NoCaptcha::renderJs() !!}
                <div class="recaptcha-container">
                    {!! NoCaptcha::display() !!}
                </div>
                <!-- Submit Button -->
                <div class="contact-page-form-group text-center">
                    <button type="submit" id="submitBtn"
                        class="contact-page-submit-btn w-full md:w-auto px-6 md:px-8 py-2.5 md:py-4 text-sm md:text-lg font-medium text-white bg-gradient-to-r from-[#22C55E] to-[#059669] hover:from-[#3fac3b] hover:to-[#22C55E] rounded-lg md:rounded-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#22C55E]">

                        <span id="submitText">Send Message</span>
                        <i id="submitIcon" class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Include the feedback component -->
@include('components.feedback')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitIcon = document.getElementById('submitIcon');

        // Loading animation SVG
        const loadingSvg = `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>`;

        // Success animation SVG
        const successSvg = `<svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>`;

        form.addEventListener('submit', async function(e) {

            e.preventDefault();
            console.log('clicked')
            // Clear previous errors
            clearErrors();

            // Show loading state
            submitBtn.disabled = true;
            submitText.innerHTML = loadingSvg;
            submitIcon.style.display = 'none'; // Hide the paper plane icon
            submitBtn.classList.add('opacity-75');

            try {
                const formData = new FormData(form);
                const response = await fetch('/api/contact-us', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: formData.get('name'),
                        email: formData.get('email'),
                        number: formData.get('number'),
                        message: formData.get('message'),
                        'g-recaptcha-response': formData.get(
                            'g-recaptcha-response') // <-- add this line
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(JSON.stringify(data.errors));
                }

                // Show success state
                submitText.innerHTML = successSvg;
                submitBtn.classList.remove('opacity-75');
                submitBtn.classList.add('bg-green-500');

                // Reset form
                form.reset();

                // Reset reCAPTCHA widget after successful submission
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }

                // Show feedback popup after successful submission
                setTimeout(function() {
                    console.log('Attempting to show feedback popup...');
                    console.log('showFeedbackPopup function exists:',
                        typeof showFeedbackPopup);
                    console.log('window.showFeedbackPopup function exists:', typeof window
                        .showFeedbackPopup);

                    function tryShowFeedbackPopup(attempt = 1) {
                        if (typeof showFeedbackPopup === 'function') {
                            console.log('showFeedbackPopup function found, calling it...');
                            showFeedbackPopup();
                        } else if (typeof window.showFeedbackPopup === 'function') {
                            console.log(
                                'window.showFeedbackPopup function found, calling it...'
                            );
                            window.showFeedbackPopup();
                        } else {
                            console.log('showFeedbackPopup function not found, attempt:',
                                attempt);
                            console.log('Available global functions:', Object.keys(window)
                                .filter(key => key.includes('feedback')));
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
                                    setTimeout(() => tryShowFeedbackPopup(attempt + 1),
                                        500);
                                }
                            }
                        }
                    }

                    tryShowFeedbackPopup();
                }, 1000); // 1 second delay

                // Reset button after 2 seconds
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitText.innerHTML = 'Send Message';
                    submitIcon.style.display =
                        'inline-block'; // Show the paper plane icon again
                    submitBtn.classList.remove('bg-green-500');
                }, 2000);

            } catch (error) {
                // Show error state
                submitBtn.disabled = false;
                submitText.innerHTML = 'Send Message';
                submitIcon.style.display = 'inline-block'; // Show the paper plane icon again
                submitBtn.classList.remove('opacity-75');

                // Handle validation errors
                try {
                    const errors = JSON.parse(error.message);
                    Object.keys(errors).forEach(key => {
                        const errorElement = document.getElementById(`${key}Error`);
                        if (errorElement) {
                            errorElement.textContent = errors[key][0];
                        }
                    });
                } catch (e) {
                    // Handle other errors
                    console.error('Error:', error);
                }
            }
        });

        function clearErrors() {
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(element => {
                element.textContent = '';
            });
        }
    });
</script>
