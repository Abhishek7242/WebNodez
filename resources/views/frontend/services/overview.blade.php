<section class="relative min-h-[80vh] bg-slate-900 py-12 md:py-20 px-4 md:px-16 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800">
        <div class="absolute inset-0 bg-[url('/images/grid-pattern.svg')] opacity-10"></div>
    </div>

    <!-- Interactive Playground -->
    <div class="relative z-10 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
            <!-- Left Content - Text -->
            <div class="text-white space-y-6 md:space-y-8">
                <div class="space-y-3 md:space-y-4">
                    <span
                        class="inline-block px-3 md:px-4 py-1.5 md:py-2 rounded-full bg-white/10 backdrop-blur-sm text-white text-xs md:text-sm font-medium">
                        Discover Our Expertise
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                        Transforming Ideas into
                        <span class="relative">
                            Digital Reality
                            <svg class="absolute -bottom-1 md:-bottom-2 left-0 w-full" height="6"
                                viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 5.5C1 5.5 50.5 1 100 5.5C149.5 10 199 5.5 199 5.5" stroke="url(#gradient)"
                                    stroke-width="2" stroke-linecap="round" />
                                <defs>
                                    <linearGradient id="gradient" x1="0" y1="0" x2="200"
                                        y2="0" gradientUnits="userSpaceOnUse">
                                        <stop offset="0%" stop-color="#FFD700" />
                                        <stop offset="100%" stop-color="#FFA500" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                    </h2>
                    <p class="text-base md:text-xl text-white/80 leading-relaxed">
                        We craft high-impact digital solutions tailored to your business needs — from design to
                        deployment.
                    </p>
                </div>

                <!-- Interactive Stats -->
                <div class="grid grid-cols-2 gap-4 md:gap-6 pt-6 md:pt-8">
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-xl md:rounded-2xl p-4 md:p-6 transform transition-all duration-300 hover:scale-105">
                        <div class="text-2xl md:text-4xl font-bold text-white mb-1 md:mb-2">
                            <span class="counter" data-target="{{ $achievements[1]['number'] }}">0</span>+
                        </div>
                        <p class="text-sm md:text-base text-white/70">Projects Completed</p>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-xl md:rounded-2xl p-4 md:p-6 transform transition-all duration-300 hover:scale-105">
                        <div class="text-2xl md:text-4xl font-bold text-white mb-1 md:mb-2">
                            <span class="counter" data-target="{{ $achievements[0]['number'] }}">0</span>+
                        </div>
                        <p class="text-sm md:text-base text-white/70">Clients</p>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-xl md:rounded-2xl p-4 md:p-6 transform transition-all duration-300 hover:scale-105">
                        <div class="text-2xl md:text-4xl font-bold text-white mb-1 md:mb-2">
                            <span class="counter" data-target="{{ $achievements[2]['number'] }}">0</span>+
                        </div>
                        <p class="text-sm md:text-base text-white/70">Reviews</p>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-xl md:rounded-2xl p-4 md:p-6 transform transition-all duration-300 hover:scale-105">
                        <div class="text-2xl md:text-4xl font-bold text-white mb-1 md:mb-2">
                            <span class="counter" data-target="98">0</span>%
                        </div>
                        <p class="text-sm md:text-base text-white/70">Client Satisfaction</p>
                    </div>
                </div>
            </div>

            <!-- Right Content - Interactive Playground -->
            <div class="relative mt-8 md:mt-0">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-primary-600/20 rounded-2xl md:rounded-3xl backdrop-blur-sm">
                </div>
                <div class="relative p-4 md:p-8">
                    <!-- Floating Elements -->
                    <div
                        class="absolute top-0 left-0 w-16 md:w-24 h-16 md:h-24 bg-accent-400/20 rounded-full mix-blend-multiply filter blur-xl animate-float">
                    </div>
                    <div
                        class="absolute bottom-0 right-0 w-20 md:w-32 h-20 md:h-32 bg-secondary-400/20 rounded-full mix-blend-multiply filter blur-xl animate-float animation-delay-2000">
                    </div>

                    <!-- Interactive Cards -->
                    <div class="space-y-4 md:space-y-6">
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-xl md:rounded-2xl p-4 md:p-6 transform transition-all duration-300 hover:scale-105 hover:bg-white/20">
                            <div class="flex items-center space-x-3 md:space-x-4">
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 bg-white/20 rounded-lg md:rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-white"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg md:text-xl font-semibold text-white">Innovation</h3>
                                    <p class="text-sm md:text-base text-white/70">Cutting-edge solutions for modern
                                        challenges</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-xl md:rounded-2xl p-4 md:p-6 transform transition-all duration-300 hover:scale-105 hover:bg-white/20">
                            <div class="flex items-center space-x-3 md:space-x-4">
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 bg-white/20 rounded-lg md:rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-white"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg md:text-xl font-semibold text-white">Security</h3>
                                    <p class="text-sm md:text-base text-white/70">Enterprise-grade protection for your
                                        data</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-xl md:rounded-2xl p-4 md:p-6 transform transition-all duration-300 hover:scale-105 hover:bg-white/20">
                            <div class="flex items-center space-x-3 md:space-x-4">
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 bg-white/20 rounded-lg md:rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-white"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg md:text-xl font-semibold text-white">Growth</h3>
                                    <p class="text-sm md:text-base text-white/70">Scalable solutions that grow with you
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>

<script>
    // Counter Animation
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 2000; // 2 seconds
            const step = target / (duration / 16); // 60fps
            let current = 0;

            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        });
    });
</script>
