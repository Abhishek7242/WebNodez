{{-- clients section --}}
<section class="clients-section py-24 px-6 md:px-12 lg:px-24 bg-gradient-to-b from-gray-900 to-gray-800 text-white">
    <h2 class="clients-heading text-center text-4xl font-bold text-white mb-10">Trust Clients By Worldwide</h2>
    <div class="clients-container max-w-6xl mx-auto">
        <div class="clients-grid grid md:grid-cols-2 gap-12 items-center">
            <div class="clients-content space-y-8">
                <div
                    class="clients-badge inline-block px-4 py-2 bg-green-500/10 rounded-full border border-green-500/20">
                    <span class="text-green-400 font-medium">Est. 2023</span>
                </div>
                <h1 class="clients-title text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                    Crafting Digital Excellence Through Innovation
                </h1>
                <p class="clients-description text-lg text-gray-300 leading-relaxed">
                    At WebNodez, we're more than just developers – we're digital architects building the future of
                    technology. Our journey is defined by innovation, expertise, and a relentless pursuit of excellence.
                </p>
                <div class="clients-stats flex flex-wrap gap-6">
                    <div class="clients-stat-item flex items-center space-x-3">
                        <div
                            class="clients-stat-icon w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center">
                            <i class="fas fa-code text-green-400 text-xl"></i>
                        </div>
                        <div class="clients-stat-content">
                            <h3 class="clients-stat-title font-semibold">Expert Team</h3>
                            <p class="clients-stat-value text-sm text-gray-400">{{ $achievements[4]['number'] }}+
                                Professionals</p>
                        </div>
                    </div>
                    <div class="clients-stat-item flex items-center space-x-3">
                        <div
                            class="clients-stat-icon w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center">
                            <i class="fas fa-globe text-green-400 text-xl"></i>
                        </div>
                        <div class="clients-stat-content">
                            <h3 class="clients-stat-title font-semibold">Global Reach</h3>
                            <p class="clients-stat-value text-sm text-gray-400">5+ Countries</p>
                        </div>
                    </div>
                    <div class="clients-stat-item flex items-center space-x-3">
                        <div
                            class="clients-stat-icon w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center">
                            <i class="fas fa-project-diagram text-green-400 text-xl"></i>
                        </div>
                        <div class="clients-stat-content">
                            <h3 class="clients-stat-title font-semibold">Projects</h3>
                            <p class="clients-stat-value text-sm text-gray-400">{{ $achievements[1]['number'] }}+
                                Completed</p>
                        </div>
                    </div>
                </div>
                <div class="clients-cta pt-6">
                    <a href="/contact-us"
                        class="clients-cta-link inline-flex items-center space-x-2 text-green-400 hover:text-green-300 transition-colors">
                        <span>Let's discuss your project</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="clients-features relative">
                <div
                    class="clients-features-bg absolute inset-0 bg-gradient-to-r from-green-500/20 to-blue-500/20 rounded-3xl transform rotate-3">
                </div>
                <div
                    class="clients-features-card relative bg-gray-800/50 backdrop-blur-sm rounded-3xl p-8 border border-gray-700/50">
                    <div class="clients-features-grid space-y-6">
                        <div class="clients-feature-item flex items-center space-x-4">
                            <div
                                class="clients-feature-icon w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center">
                                <i class="fas fa-rocket text-green-400 text-xl"></i>
                            </div>
                            <div class="clients-feature-content">
                                <h3 class="clients-feature-title font-semibold">Innovation First</h3>
                                <p class="clients-feature-description text-sm text-gray-400">Pushing boundaries in tech
                                </p>
                            </div>
                        </div>
                        <div class="clients-feature-item flex items-center space-x-4">
                            <div
                                class="clients-feature-icon w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
                                <i class="fas fa-users text-blue-400 text-xl"></i>
                            </div>
                            <div class="clients-feature-content">
                                <h3 class="clients-feature-title font-semibold">Client Success</h3>
                                <p class="clients-feature-description text-sm text-gray-400">Your goals are our priority
                                </p>
                            </div>
                        </div>
                        <div class="clients-feature-item flex items-center space-x-4">
                            <div
                                class="clients-feature-icon w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center">
                                <i class="fas fa-shield-alt text-purple-400 text-xl"></i>
                            </div>
                            <div class="clients-feature-content">
                                <h3 class="clients-feature-title font-semibold">Quality Assured</h3>
                                <p class="clients-feature-description text-sm text-gray-400">Excellence in every detail
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
