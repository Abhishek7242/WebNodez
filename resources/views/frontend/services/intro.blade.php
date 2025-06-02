{{-- header Section --}}
<section
    class="services-section relative py-12 md:py-16 lg:py-20 px-4 md:px-8 lg:px-24 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
    <!-- Decorative Elements -->
    <div class="services-decorative absolute top-0 left-0 w-full h-full">
        <div
            class="services-decorative-top absolute top-0 left-0 w-1/3 h-1/3 bg-blue-50 rounded-br-[50px] md:rounded-br-[100px]">
        </div>
        <div
            class="services-decorative-bottom absolute bottom-0 right-0 w-1/3 h-1/3 bg-blue-50 rounded-tl-[50px] md:rounded-tl-[100px]">
        </div>
    </div>

    <div class="services-container max-w-7xl mx-auto relative">
        <div class="services-grid grid lg:grid-cols-2 gap-8 md:gap-12 lg:gap-16 items-center">
            <!-- Left Content -->
            <div class="services-left space-y-6 md:space-y-8 lg:space-y-10">
                <div class="services-badge inline-flex items-center space-x-2 md:space-x-3">
                    <div class="services-badge-line w-1.5 md:w-2 h-6 md:h-8 bg-blue-500 rounded-full"></div>
                    <span class="services-badge-text font-medium text-base md:text-lg">What We Do</span>
                </div>
                <div class="services-heading-wrapper space-y-4 md:space-y-6">
                    <h1
                        class="services-heading text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight">
                        Services
                    </h1>
                    <p
                        class="services-description text-base md:text-lg lg:text-xl text-gray-600 leading-relaxed max-w-2xl">
                        Discover our comprehensive range of digital solutions designed to elevate your business. From
                        web development to mobile apps, we deliver excellence in every project.
                    </p>
                </div>

                <!-- Service Buttons -->
                <div class="services-buttons grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                    <a href="#contact" class="services-button group p-4 md:p-5 rounded-xl">
                        <div class="services-button-icon text-xl md:text-2xl mb-2 md:mb-3">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="services-button-title font-semibold text-sm md:text-base">Lets Chat</div>
                    </a>
                    <a href="#services" class="services-button group p-4 md:p-5 rounded-xl">
                        <div class="services-button-icon text-xl md:text-2xl mb-2 md:mb-3">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="services-button-title font-semibold text-sm md:text-base">Services</div>
                    </a>
                </div>
            </div>

            <!-- Right Content - Interactive Playground -->
            <div class="services-playground-container relative mt-8 lg:mt-0">
                <div class="services-playground w-full aspect-square max-w-lg mx-auto">
                    <!-- Main Circle -->
                    <div
                        class="services-playground-circle absolute inset-0 rounded-full bg-gradient-to-br from-blue-500/10 to-blue-600/10 backdrop-blur-sm border border-blue-200/20">
                    </div>

                    <!-- Floating Services Center -->
                    <div class="services-playground-center absolute inset-0 flex items-center justify-center">
                        <div class="services-floating">
                            <!-- Service Names -->
                            <div class="services-name" data-speed="2" data-direction="1">Web Development</div>
                            <div class="services-name" data-speed="3" data-direction="-1">Mobile Apps</div>
                            <div class="services-name" data-speed="4" data-direction="1">UI/UX Design</div>
                            <div class="services-name" data-speed="2.5" data-direction="-1">Cloud Services</div>

                            <!-- Floating Icons -->
                            <div class="services-icon" data-speed="2">
                                <div class="services-icon-box">
                                    <i class="services-icon-i fas fa-code text-xl md:text-2xl"></i>
                                </div>
                            </div>
                            <div class="services-icon" data-speed="3">
                                <div class="services-icon-box">
                                    <i class="services-icon-i fas fa-mobile-alt text-xl md:text-2xl"></i>
                                </div>
                            </div>
                            <div class="services-icon" data-speed="4">
                                <div class="services-icon-box">
                                    <i class="services-icon-i fas fa-paint-brush text-xl md:text-2xl"></i>
                                </div>
                            </div>
                            <div class="services-icon" data-speed="2.5">
                                <div class="services-icon-box">
                                    <i class="services-icon-i fas fa-server text-xl md:text-2xl"></i>
                                </div>
                            </div>

                            <!-- Center Element -->
                            <div class="services-center-element rounded-full">
                                <div
                                    class="services-center-button w-20 h-20 md:w-24 md:h-24 rounded-full bg-gradient-to-br from-green-500 to-white flex items-center justify-center transform hover:scale-110 transition-all duration-300 cursor-pointer group">
                                    <div class="services-center-content text-white text-center">
                                        <div
                                            class="services-center-icon text-xl md:text-2xl mb-1 group-hover:rotate-12 transition-transform duration-300">
                                            🚀</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Get in Touch Button -->
                    <div class="services-contact-container">
                        <a href="/contact-us" class="services-contact-btn group">
                            <span class="services-contact-text text-sm md:text-base">Get in Touch</span>
                            <div class="services-contact-bg absolute inset-0 rounded-full"></div>
                            <div class="services-contact-border absolute inset-0"></div>
                        </a>
                    </div>

                    <!-- Floating Particles -->
                    <div class="services-particles">
                        <div class="services-particle"></div>
                        <div class="services-particle"></div>
                        <div class="services-particle"></div>
                        <div class="services-particle"></div>
                        <div class="services-particle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
