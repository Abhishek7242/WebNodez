<section id="contact" class="contact-page-section py-16 md:py-20 px-4 md:px-12 lg:px-24 bg-gradient-to-br from-gray-50 to-white">
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
            <form class="contact-page-form space-y-4 md:space-y-6" action="" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <!-- Name Field -->
                    <div class="contact-page-form-group">
                        <div class="contact-page-input-wrapper">
                            <input type="text" id="name" name="name"
                                class="contact-page-input w-full px-3 md:px-4 py-2.5 md:py-3.5 rounded-lg md:rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300 text-sm md:text-base"
                                placeholder="Your Name" required>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="contact-page-form-group">
                        <div class="contact-page-input-wrapper">
                            <input type="email" id="email" name="email"
                                class="contact-page-input w-full px-3 md:px-4 py-2.5 md:py-3.5 rounded-lg md:rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300 text-sm md:text-base"
                                placeholder="Your Email" required>
                        </div>
                    </div>
                </div>

                <!-- Phone Field (Optional) -->
                <div class="contact-page-form-group">
                    <div class="contact-page-input-wrapper">
                        <input type="tel" id="phone" name="phone"
                            class="contact-page-input w-full px-3 md:px-4 py-2.5 md:py-3.5 rounded-lg md:rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300 text-sm md:text-base"
                            placeholder="Phone Number (Optional)">
                    </div>
                </div>

                <!-- Message Field -->
                <div class="contact-page-form-group">
                    <div class="contact-page-input-wrapper">
                        <textarea id="message" name="message" rows="4"
                            class="contact-page-input w-full px-3 md:px-4 py-2.5 md:py-3.5 rounded-lg md:rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300 resize-none text-sm md:text-base"
                            placeholder="Your Message" required></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="contact-page-form-group text-center">
                    <button type="submit"
                        class="contact-page-submit-btn w-full md:w-auto px-6 md:px-8 py-2.5 md:py-4 text-sm md:text-lg font-medium text-white bg-gradient-to-r from-[#22C55E] to-[#059669] hover:from-[#3fac3b] hover:to-[#22C55E] rounded-lg md:rounded-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#22C55E]">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
