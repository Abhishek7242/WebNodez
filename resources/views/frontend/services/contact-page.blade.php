<section class="contact-page-section py-20 px-6 md:px-12 lg:px-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="contact-page-container max-w-4xl mx-auto">
        <!-- Section Header -->
        <div class="contact-page-header text-center mb-16">
            <div class="contact-page-badge flex items-center justify-center space-x-3 mb-6">
                <div class="contact-page-badge-line w-2 h-8 rounded-full"></div>
                <span class="contact-page-badge-text font-medium text-lg">Get in Touch</span>
            </div>
            <h2 class="contact-page-title text-4xl md:text-5xl font-bold mb-6">Contact Us</h2>
            <p class="contact-page-description text-xl text-gray-600">
                Have a question or want to work together? We'd love to hear from you.
            </p>
        </div>

        <!-- Contact Form -->
        <div class="contact-page-form-container bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <form class="contact-page-form space-y-6" action="" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name Field -->
                    <div class="contact-page-form-group">
                        <div class="contact-page-input-wrapper">
                            <input type="text" id="name" name="name"
                                class="contact-page-input w-full px-4 py-3.5 rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300"
                                placeholder="Your Name" required>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="contact-page-form-group">
                        <div class="contact-page-input-wrapper">
                            <input type="email" id="email" name="email"
                                class="contact-page-input w-full px-4 py-3.5 rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300"
                                placeholder="Your Email" required>
                        </div>
                    </div>
                </div>

                <!-- Phone Field (Optional) -->
                <div class="contact-page-form-group">
                    <div class="contact-page-input-wrapper">
                        <input type="tel" id="phone" name="phone"
                            class="contact-page-input w-full px-4 py-3.5 rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300"
                            placeholder="Phone Number (Optional)">
                    </div>
                </div>

                <!-- Message Field -->
                <div class="contact-page-form-group">
                    <div class="contact-page-input-wrapper">
                        <textarea id="message" name="message" rows="5"
                            class="contact-page-input w-full px-4 py-3.5 rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-gray-200 transition-all duration-300 resize-none"
                            placeholder="Your Message" required></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="contact-page-form-group text-center">
                    <button type="submit"
                        class="contact-page-submit-btn w-full md:w-auto px-8 py-4 text-lg font-medium text-white bg-gradient-to-r from-[#22C55E] to-[#059669] hover:from-[#3fac3b] hover:to-[#22C55E] rounded-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#22C55E]">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
