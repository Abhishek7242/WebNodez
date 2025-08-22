@extends('admin/layouts/main')
@section('title', 'Linkuss - Admin Dashboard')
@section('home', 'active')
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
    <div id="canvas-background" class="canvas-background h-100vh"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white');
        el.style.setProperty('--dark-bg', 'white');
    </script>

    <div class=" flex items-center justify-center ">
        <div class="text-center p-8 relative">
            <!-- Animated background elements -->
            {{-- <div class="absolute inset-0 -z-10">
                <div
                    class="absolute top-0 left-0 w-32 h-32 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob">
                </div>
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000">
                </div>
                <div
                    class="absolute -bottom-8 left-20 w-32 h-32 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000">
                </div>
            </div> --}}

            <!-- Welcome content -->
            <div class="space-y-6 h-full">
                <h1 class="text-5xl font-bold text-white mb-4 tracking-tight">
                    Welcome <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Boss</span>
                </h1>
                <p class="text-gray-300 text-xl max-w-2xl mx-auto">
                    Your command center is ready. Take control of your digital empire.
                </p>

                <!-- Quick stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-12">

                    <a href="/admin/user-ai-chats"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-comments text-4xl text-pink-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Users AI Chat</div>
                        <div class="text-sm text-gray-400 mt-1">Active Conversations</div>
                    </a>
                    @if (Auth::guard('admin')->user()->role == 'super_admin' || Auth::guard('admin')->user()->role == 'god_admin')
                        <a href="/admin/manage-admins"
                            class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                            <div class="flex items-center justify-center mb-2">
                                <i class="fas fa-user-shield text-4xl text-blue-400 group-hover:animate-pulse"></i>
                            </div>
                            <div class="text-gray-300">Manage Admins</div>
                            <div class="text-sm text-gray-400 mt-1">Admin Controls</div>
                        </a>
                    @endif
                    <a href="/admin/contact-details"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-envelope text-4xl text-pink-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Contact Messages</div>
                        <div class="text-sm text-gray-400 mt-1">View Submissions</div>
                    </a>
                    <a href="/admin/manage-blogs"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-blog text-4xl text-green-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Manage Blogs</div>
                        <div class="text-sm text-gray-400 mt-1">Create & Edit Posts</div>
                    </a>
                    <a href="/admin/manage-home"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-home text-4xl text-blue-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Manage Home</div>
                        <div class="text-sm text-gray-400 mt-1">Homepage Content</div>
                    </a>
                    <a href="/admin/manage-services"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-cogs text-4xl text-purple-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Manage Services</div>
                        <div class="text-sm text-gray-400 mt-1">Service Listings</div>
                    </a>
                    <a href="/admin/manage-about"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-info-circle text-4xl text-yellow-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">About Us</div>
                        <div class="text-sm text-gray-400 mt-1">Company Info</div>
                    </a>
                    <a href="/admin/manage-portfolio"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-briefcase text-4xl text-red-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Portfolio</div>
                        <div class="text-sm text-gray-400 mt-1">Project Showcase</div>
                    </a>
                    <a href="/admin/manage-terms"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-file-contract text-4xl text-indigo-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Terms & Conditions</div>
                        <div class="text-sm text-gray-400 mt-1">Legal Documents</div>
                    </a>
                    <a href="/admin/manage-privacy"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-shield-alt text-4xl text-teal-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Privacy Policy</div>
                        <div class="text-sm text-gray-400 mt-1">Data Protection</div>
                    </a>
                    <a href="/admin/manage-og-images"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-images text-4xl text-orange-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">OG Images</div>
                        <div class="text-sm text-gray-400 mt-1">Meta Images</div>
                    </a>
                    <a href="/admin/manage-client-progress"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-chart-line text-4xl text-orange-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Manage Progress</div>
                        <div class="text-sm text-gray-400 mt-1">Client project progress and status</div>
                    </a>
                    <a href="/admin/manage-feedback"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-star text-4xl text-yellow-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">User Feedback</div>
                        <div class="text-sm text-gray-400 mt-1">View ratings and comments</div>
                    </a>
                    <a href="/admin/send-email"
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-envelope text-4xl text-pink-400 group-hover:animate-pulse"></i>
                        </div>
                        <div class="text-gray-300">Send Email</div>
                        <div class="text-sm text-gray-400 mt-1">Send emails to users</div>
                    </a>
                </div>

                {{-- <!-- Quick actions -->
                <div class="mt-12">
                    <button
                        class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-1">
                        Launch Dashboard
                    </button>
                </div> --}}
            </div>
        </div>
    </div>
    </header>

    <style>
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
    </style>

@endsection
