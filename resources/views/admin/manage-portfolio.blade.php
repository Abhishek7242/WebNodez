@extends('admin/layouts/main')
@section('title', 'WebNodez - Manage Portfolio')
@section('portfolio', 'active')
@section('main-section')

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
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
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Portfolio Management</h1>
                    <p class="text-gray-400">Manage your portfolio sections and content</p>
                </div>
            </div>

            <!-- Portfolio Sections -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Design Gallery Button -->
                <div
                    class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-blue-500/20 cursor-pointer group">
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-images text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Design Gallery</h3>
                        <p class="text-gray-400 mb-4">Showcase your creative designs and visual work</p>
                        <a href="/admin/manage-portfolio/gallery"
                            class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                            Manage Gallery
                        </a>
                    </div>
                </div>
                <!-- Case Studies Button -->
                <div
                    class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-green-500/20 cursor-pointer group">
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="h-16 w-16 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-briefcase text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Case Studies</h3>
                        <p class="text-gray-400 mb-4">Highlight your successful projects and client work</p>
                        <a href="/admin/manage-portfolio/case-studies"
                            class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-green-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                            Manage Cases
                        </a>
                    </div>
                </div>

                <!-- Our Achievements Button -->
                <div
                    class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-purple-500/20 cursor-pointer group">
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="h-16 w-16 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-trophy text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Our Achievements</h3>
                        <p class="text-gray-400 mb-4">Display your awards, certifications, and milestones</p>
                        <a href="/admin/manage-portfolio/achievements"
                            class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-purple-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                            Manage Achievements
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@endsection
