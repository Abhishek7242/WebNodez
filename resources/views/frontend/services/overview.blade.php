{{-- @php
$services = [
    [
        'title' => 'Web Development',
        'description' => 'Responsive, SEO-friendly websites built to scale with performance in mind.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 18l6-6-6-6M8 6l-6 6 6 6" />
        </svg>',
        'link' => '/services/web-development',
    ],
    [
        'title' => 'App Design & Development',
        'description' => 'Custom mobile apps that are fast, beautiful, and user-friendly across platforms.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 18h.01M8 6h8M8 10h8m-4 8h.01M6 6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2H6z" />
        </svg>',
        'link' => '/services/app-design&development',
    ],
    [
        'title' => 'UI/UX Design',
        'description' => 'Human-first design with clean, modern interfaces for an effortless user experience.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h16M4 18h16M4 12h8" />
        </svg>',
        'link' => '/services/ui-ux-design',
    ],
    [
        'title' => 'E-Commerce Solutions',
        'description' => 'Secure and scalable online stores designed to convert and grow your brand.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007 17h10a1 1 0 00.95-.68L20 13M7 13V6H5" />
        </svg>',
        'link' => '/services/e_commerce-solutions',
    ],
    [
        'title' => 'Testing',
        'description' => 'End-to-end quality assurance to ensure smooth performance, security, and user satisfaction across all platforms.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M9 12h6m-6 4h3m-3-8h6M4 6h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
        </svg>',
        'link' => '/services/testing',
    ],
    [
        'title' => 'Maintenance & Support',
        'description' => 'Ongoing updates, monitoring, and fixes to keep your site or app running flawlessly.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 6v6l4 2M6 18h12M6 6h12a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2z" />
        </svg>',
        'link' => '/services/maintenance&support',
    ],
];
@endphp

<section class="border-tbg-gray-50 py-20 px-6 md:px-12 lg:px-24">
<div class="max-w-7xl mx-auto text-center">
<h2 class="text-4xl font-bold text-gray-900 mb-4">Our Services - <span class="text-gray-700" >What We Do Best</span></h2>
<p class="text-gray-400 text-lg mb-16  mx-auto">
From stunning web designs to high-performing apps, we build digital products your users will love.
</p>

<div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">

<!-- Card Template -->
@foreach ($services as $service)
    <x-services
      :title="$service['title']"
      :description="$service['description']"
      :link="$service['link']"
      :icon="$service['icon']"
    />
@endforeach



</div>
</div>
</section> --}}
<section class="relative min-h-[80vh] bg-slate-900 py-20 px-6 md:px-16 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800">
        <div class="absolute inset-0 bg-[url('/images/grid-pattern.svg')] opacity-10"></div>
    </div>

    <!-- Interactive Playground -->
    <div class="relative z-10 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content - Text -->
            <div class="text-white space-y-8">
                <div class="space-y-4">
                    <span
                        class="inline-block px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm text-white text-sm font-medium">
                        Discover Our Expertise
                    </span>
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                        Transforming Ideas into
                        <span class="relative">
                            Digital Reality
                            <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    </h1>
                    <p class="text-xl text-white/80 leading-relaxed">
                        We craft high-impact digital solutions tailored to your business needs — from design to
                        deployment.
                    </p>
                </div>

                <!-- Interactive Stats -->
                <div class="grid grid-cols-2 gap-6 pt-8">
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transform transition-all duration-300 hover:scale-105">
                        <div class="text-4xl font-bold text-white mb-2">
                            <span class="counter" data-target="500">0</span>+
                        </div>
                        <p class="text-white/70">Projects Completed</p>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transform transition-all duration-300 hover:scale-105">
                        <div class="text-4xl font-bold text-white mb-2">
                            <span class="counter" data-target="200">0</span>+
                        </div>
                        <p class="text-white/70">Clients</p>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transform transition-all duration-300 hover:scale-105">
                        <div class="text-4xl font-bold text-white mb-2">
                            <span class="counter" data-target="100">0</span>+
                        </div>
                        <p class="text-white/70">Reviews</p>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transform transition-all duration-300 hover:scale-105">
                        <div class="text-4xl font-bold text-white mb-2">
                            <span class="counter" data-target="98">0</span>%
                        </div>
                        <p class="text-white/70">Client Satisfaction</p>
                    </div>
                </div>
            </div>

            <!-- Right Content - Interactive Playground -->
            <div class="relative">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-primary-600/20 rounded-3xl backdrop-blur-sm">
                </div>
                <div class="relative p-8">
                    <!-- Floating Elements -->
                    <div
                        class="absolute top-0 left-0 w-24 h-24 bg-accent-400/20 rounded-full mix-blend-multiply filter blur-xl animate-float">
                    </div>
                    <div
                        class="absolute bottom-0 right-0 w-32 h-32 bg-secondary-400/20 rounded-full mix-blend-multiply filter blur-xl animate-float animation-delay-2000">
                    </div>

                    <!-- Interactive Cards -->
                    <div class="space-y-6">
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transform transition-all duration-300 hover:scale-105 hover:bg-white/20">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Innovation</h3>
                                    <p class="text-white/70">Cutting-edge solutions for modern challenges</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transform transition-all duration-300 hover:scale-105 hover:bg-white/20">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Security</h3>
                                    <p class="text-white/70">Enterprise-grade protection for your data</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 transform transition-all duration-300 hover:scale-105 hover:bg-white/20">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Growth</h3>
                                    <p class="text-white/70">Scalable solutions that grow with you</p>
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

