@extends('frontend/layouts/main')
@section('title', 'Pricing - ' . $service)
@section('', 'active')
@section('main-section')
    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');
    </script>
    {{-- intro section --}}
    <section class="relative py-32 px-6 md:px-16 overflow-hidden bg-gradient-to-b from-[var(--intro-bg)] via-white to-white">
        {{-- Animated background elements --}}
        <div class="absolute inset-0">
            <div
                class="absolute top-0 left-0 w-96 h-96 bg-[var(--color-primary)] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob">
            </div>
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-[var(--color-secondary)] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-20 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-6000">
            </div>
        </div>

        {{-- Decorative grid pattern --}}
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>

        <div class="relative max-w-5xl mx-auto">
            {{-- Top badge --}}
            <div class="flex justify-center mb-8">
                <span
                    class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)] bg-opacity-10 text-[var(--intro-bg)] text-sm font-semibold shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    Transparent Pricing Plans
                </span>
            </div>

            {{-- Main content --}}
            <div class="text-center">
                <h1
                    class="text-5xl md:text-7xl font-bold mb-8 bg-clip-text text-transparent bg-gradient-to-r from-gray-900 via-[var(--color-primary)] to-gray-900 leading-tight">
                    {{ $service }}
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 leading-relaxed max-w-3xl mx-auto mb-12">
                    {{ $details['description'] }}
                </p>
            </div>

            {{-- Decorative elements --}}
            <div class="flex justify-center items-center space-x-4 mb-12">
                <div class="w-24 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)] rounded-full">
                </div>
                <div class="w-3 h-3 bg-[var(--color-primary)] rounded-full animate-pulse"></div>
                <div class="w-24 h-1 bg-gradient-to-r from-[var(--color-secondary)] to-[var(--color-primary)] rounded-full">
                </div>
            </div>

            {{-- Scroll indicator --}}
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                    </path>
                </svg>
            </div>
        </div>
    </section>

    <style>
        .bg-grid-pattern {
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .animation-delay-6000 {
            animation-delay: 6s;
        }
    </style>

    <x-service-detail :serviceHeading="$service" :detailsArray='$detailsArray' />

    <section class="bg-gray-50 py-20 px-6 md:px-12">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Ready to Start Your Project?</h2>
            <p class="text-lg text-gray-600 mb-8">
                Whether you're launching a new app, redesigning your website, or need help bringing your product to life —
                we're here to help. Let's build something great together.
            </p>
            <a href="/contact-us"
                class="inline-block bg-[var(--color-primary)] hover:bg-[var(--color-secondary)] text-white text-lg font-semibold py-3 px-8 rounded-full transition duration-300">
                Contact Us
            </a>
        </div>
    </section>

@endsection
