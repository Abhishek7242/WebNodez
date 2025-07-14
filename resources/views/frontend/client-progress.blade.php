@extends('frontend/layouts/main')
@section('title', 'Project Progress - Linkuss')
@section('main-section')

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/client-progress.css') }}" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Three.js and other required scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="{{ asset('js/canvas-background.js') }}"></script>

    <!-- Canvas background container -->
    <div id="canvas-background" class="canvas-background"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white');
        el.style.setProperty('--dark-bg', 'white');
    </script>

    <div class="min-h-screen p-6">
        <div class="max-w-6xl mx-auto">
            @if ($project)
                <!-- Header Section -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-white mb-4">{{ $project->project_name }}</h1>
                    <p class="text-gray-400 text-lg">Your project progress and status</p>
                </div>

                <!-- Project Overview -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Project Image and Basic Info -->
                    <div class="lg:col-span-2">
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <div class="relative mb-6">
                                <img src="{{ $project->image }}" alt="{{ $project->project_name }}"
                                    class="w-full h-64 object-cover rounded-lg">
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="px-3 py-1 text-sm font-semibold rounded-full {{ $project->getStatusBadgeClass() }}">
                                        {{ $project->getStatusText() }}
                                    </span>
                                </div>
                            </div>

                            <h2 class="text-2xl font-bold text-white mb-4">Project Description</h2>
                            <p class="text-gray-300 leading-relaxed">{{ $project->description }}</p>
                        </div>
                    </div>

                    <!-- Project Stats -->
                    <div class="space-y-6">
                        <!-- Progress Card -->
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-white mb-4">Overall Progress</h3>

                            <!-- Progress Circle -->
                            <div class="flex justify-center mb-4">
                                <div class="relative w-32 h-32">
                                    <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 120 120">
                                        <circle cx="60" cy="60" r="54" fill="none" stroke="#374151"
                                            stroke-width="8" />
                                        <circle cx="60" cy="60" r="54" fill="none" stroke="url(#gradient)"
                                            stroke-width="8" stroke-dasharray="{{ 2 * pi() * 54 }}"
                                            stroke-dashoffset="{{ 2 * pi() * 54 * (1 - $project->progress_percentage / 100) }}"
                                            stroke-linecap="round" />
                                        <defs>
                                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%"
                                                y2="0%">
                                                <stop offset="0%" style="stop-color:#3B82F6" />
                                                <stop offset="100%" style="stop-color:#8B5CF6" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span
                                            class="text-2xl font-bold text-white">{{ $project->progress_percentage }}%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-400 mb-2">
                                    <span>Completion</span>
                                    <span>{{ $project->progress_percentage }}%</span>
                                </div>
                                <div class="w-full bg-gray-700 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-3 rounded-full transition-all duration-500"
                                        style="width: {{ $project->progress_percentage }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Project Details -->
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-white mb-4">Project Details</h3>

                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Status:</span>
                                    <span class="text-white font-medium">{{ $project->getStatusText() }}</span>
                                </div>

                                @if ($project->start_date)
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Start Date:</span>
                                        <span class="text-white">{{ $project->start_date->format('M d, Y') }}</span>
                                    </div>
                                @endif

                                @if ($project->expected_completion_date)
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Expected Completion:</span>
                                        <span
                                            class="text-white">{{ $project->expected_completion_date->format('M d, Y') }}</span>
                                    </div>

                                    @php
                                        $today = now();
                                        $expectedDate = $project->expected_completion_date;
                                        $daysRemaining = $today->diffInDays($expectedDate, false);
                                        $isOverdue = $daysRemaining < 0;
                                    @endphp

                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Time Remaining:</span>
                                        <span class="text-white {{ $isOverdue ? 'text-red-400' : 'text-green-400' }}">
                                            @if ($isOverdue)
                                                {{ abs($daysRemaining) }} days overdue
                                            @else
                                                {{ $daysRemaining }} days
                                            @endif
                                        </span>
                                    </div>
                                @endif

                                <div class="flex justify-between">
                                    <span class="text-gray-400">Last Updated:</span>
                                    <span class="text-white">{{ $project->updated_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Phases -->
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 mb-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Project Phases</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Design Phase -->
                        <div class="bg-white/5 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-white">Design</h3>
                                <span
                                    class="px-3 py-1 text-xs rounded-full {{ $project->design_completed ? 'bg-green-500 text-white' : 'bg-gray-500 text-gray-300' }}">
                                    {{ $project->design_completed ? 'Completed' : 'In Progress' }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2 mb-2">
                                <div class="bg-green-500 h-2 rounded-full transition-all duration-500"
                                    style="width: {{ $project->design_completed ? '100' : '0' }}%"></div>
                            </div>
                            <p class="text-sm text-gray-400">
                                {{ $project->design_completed ? 'Design phase completed successfully' : 'Design work in progress' }}
                            </p>
                        </div>

                        <!-- Development Phase -->
                        <div class="bg-white/5 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-white">Development</h3>
                                <span
                                    class="px-3 py-1 text-xs rounded-full {{ $project->development_completed ? 'bg-green-500 text-white' : 'bg-gray-500 text-gray-300' }}">
                                    {{ $project->development_completed ? 'Completed' : 'Pending' }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2 mb-2">
                                <div class="bg-green-500 h-2 rounded-full transition-all duration-500"
                                    style="width: {{ $project->development_completed ? '100' : '0' }}%"></div>
                            </div>
                            <p class="text-sm text-gray-400">
                                {{ $project->development_completed ? 'Development phase completed successfully' : 'Development will start after design completion' }}
                            </p>
                        </div>

                        <!-- Testing Phase -->
                        <div class="bg-white/5 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-white">Testing</h3>
                                <span
                                    class="px-3 py-1 text-xs rounded-full {{ $project->testing_completed ? 'bg-green-500 text-white' : 'bg-gray-500 text-gray-300' }}">
                                    {{ $project->testing_completed ? 'Completed' : 'Pending' }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2 mb-2">
                                <div class="bg-green-500 h-2 rounded-full transition-all duration-500"
                                    style="width: {{ $project->testing_completed ? '100' : '0' }}%"></div>
                            </div>
                            <p class="text-sm text-gray-400">
                                {{ $project->testing_completed ? 'Testing phase completed successfully' : 'Testing will start after development completion' }}
                            </p>
                        </div>

                        <!-- Deployment Phase -->
                        <div class="bg-white/5 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-white">Deployment</h3>
                                <span
                                    class="px-3 py-1 text-xs rounded-full {{ $project->deployment_completed ? 'bg-green-500 text-white' : 'bg-gray-500 text-gray-300' }}">
                                    {{ $project->deployment_completed ? 'Completed' : 'Pending' }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2 mb-2">
                                <div class="bg-green-500 h-2 rounded-full transition-all duration-500"
                                    style="width: {{ $project->deployment_completed ? '100' : '0' }}%"></div>
                            </div>
                            <p class="text-sm text-gray-400">
                                {{ $project->deployment_completed ? 'Project deployed successfully' : 'Deployment will start after testing completion' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Progress Timeline -->
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 mb-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Project Timeline</h2>

                    <div class="relative">
                        <!-- Timeline Line -->
                        <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-600"></div>

                        <!-- Timeline Items -->
                        <div class="space-y-6">
                            <!-- Project Started -->
                            @if ($project->start_date)
                                <div class="relative flex items-start">
                                    <div
                                        class="absolute left-4 w-4 h-4 bg-green-500 rounded-full border-4 border-gray-800">
                                    </div>
                                    <div class="ml-12">
                                        <h4 class="text-lg font-semibold text-white">Project Started</h4>
                                        <p class="text-gray-400">{{ $project->start_date->format('F d, Y') }}</p>
                                        <p class="text-gray-300 mt-2">Project development began with initial planning and
                                            setup.</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Current Progress -->
                            <div class="relative flex items-start">
                                <div class="absolute left-4 w-4 h-4 bg-blue-500 rounded-full border-4 border-gray-800">
                                </div>
                                <div class="ml-12">
                                    <h4 class="text-lg font-semibold text-white">Current Progress</h4>
                                    <p class="text-gray-400">{{ $project->updated_at->format('F d, Y') }}</p>
                                    <p class="text-gray-300 mt-2">Project is {{ $project->progress_percentage }}%
                                        complete.</p>
                                    <div class="mt-3">
                                        <div class="w-full bg-gray-700 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-500"
                                                style="width: {{ $project->progress_percentage }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Expected Completion -->
                            @if ($project->expected_completion_date)
                                <div class="relative flex items-start">
                                    <div
                                        class="absolute left-4 w-4 h-4 bg-purple-500 rounded-full border-4 border-gray-800">
                                    </div>
                                    <div class="ml-12">
                                        <h4 class="text-lg font-semibold text-white">Expected Completion</h4>
                                        <p class="text-gray-400">
                                            {{ $project->expected_completion_date->format('F d, Y') }}</p>
                                        <p class="text-gray-300 mt-2">Target completion date for project delivery.</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Project Completed (if applicable) -->
                            @if ($project->status === 'completed')
                                <div class="relative flex items-start">
                                    <div
                                        class="absolute left-4 w-4 h-4 bg-green-500 rounded-full border-4 border-gray-800">
                                    </div>
                                    <div class="ml-12">
                                        <h4 class="text-lg font-semibold text-white">Project Completed</h4>
                                        <p class="text-gray-400">{{ $project->updated_at->format('F d, Y') }}</p>
                                        <p class="text-gray-300 mt-2">Project has been successfully completed and
                                            delivered.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 text-center">
                    <h2 class="text-2xl font-bold text-white mb-4">Need Help?</h2>
                    <p class="text-gray-300 mb-6">If you have any questions about your project or need to discuss any
                        aspect, please don't hesitate to reach out to us.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="/contact-us"
                            class="bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition-colors">
                            <i class="fas fa-envelope mr-2"></i>Contact Us
                        </a>
                        <a href="tel:+1234567890"
                            class="bg-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition-colors">
                            <i class="fas fa-phone mr-2"></i>Call Us
                        </a>
                    </div>
                </div>
            @else
                <!-- Project Not Found -->
                <div class="text-center py-12">
                    <i class="fas fa-exclamation-triangle text-6xl text-red-500 mb-4"></i>
                    <h3 class="text-2xl font-semibold text-white mb-2">Project Not Found</h3>
                    <p class="text-gray-400 mb-6">The project you're looking for doesn't exist or the link is invalid.</p>
                    <a href="/"
                        class="bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition-colors">
                        <i class="fas fa-home mr-2"></i>Go to Homepage
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Animate progress bars on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Animate progress bars
            const progressBars = document.querySelectorAll('.bg-gradient-to-r');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });

            // Animate progress circle
            const progressCircle = document.querySelector('circle[stroke-dasharray]');
            if (progressCircle) {
                const circumference = 2 * Math.PI * 54;
                const progress = {{ $project ? $project->progress_percentage : 0 }};
                const offset = circumference - (progress / 100) * circumference;

                progressCircle.style.strokeDashoffset = circumference;
                setTimeout(() => {
                    progressCircle.style.strokeDashoffset = offset;
                }, 1000);
            }

            // Add scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all cards for animation
            const cards = document.querySelectorAll('.bg-white\\/10');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });

        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

@endsection
