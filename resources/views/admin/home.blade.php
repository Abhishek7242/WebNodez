@extends('admin/layouts/main')
@section('title', 'Linkuss - Admin Dashboard')
@section('home', 'active')
@section('main-section')

<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="{{ asset('js/canvas-background.js') }}"></script>

<div id="canvas-background" class="canvas-background h-100vh"></div>

<script>
    const el = document.querySelector('#header');
    el.style.setProperty('--intro-bg', 'white');
    el.style.setProperty('--dark-bg', 'white');
</script>

<!-- =================== Admin Home =================== -->
<div class="relative z-50 flex flex-col items-center justify-between h-screen py-12 space-y-12">

    <!-- Welcome Section -->
    <div class="text-center">
        <h1 class="text-4xl font-bold text-white">Welcome to Linkuss Admin Dashboard</h1>
        <p class="text-gray-300 mt-2">Manage users, blogs, services, and more — all in one place</p>
    </div>

   <!-- =================== Middle Content =================== -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl w-full px-6">

    <!-- Card 1 -->
    <div class="bg-black/40 backdrop-blur-lg p-6 rounded-2xl shadow-lg border border-white/10">
        <i class="fas fa-users text-blue-400 text-3xl mb-3"></i>
        <h3 class="text-lg font-semibold text-white">User Management</h3>
        <p class="text-gray-400 mt-1 text-sm">
            View, edit, and manage registered users, roles, and permissions.
        </p>
    </div>

    <!-- Card 2 -->
    <div class="bg-black/40 backdrop-blur-lg p-6 rounded-2xl shadow-lg border border-white/10">
        <i class="fas fa-blog text-green-400 text-3xl mb-3"></i>
        <h3 class="text-lg font-semibold text-white">Content & Blogs</h3>
        <p class="text-gray-400 mt-1 text-sm">
            Publish articles, update blog posts, and control featured content.
        </p>
    </div>

    <!-- Card 3 -->
    <div class="bg-black/40 backdrop-blur-lg p-6 rounded-2xl shadow-lg border border-white/10">
        <i class="fas fa-cogs text-purple-400 text-3xl mb-3"></i>
        <h3 class="text-lg font-semibold text-white">Services</h3>
        <p class="text-gray-400 mt-1 text-sm">
            Update service information, pricing, and active offerings.
        </p>
    </div>

    <!-- Card 4 -->
    <div class="bg-black/40 backdrop-blur-lg p-6 rounded-2xl shadow-lg border border-white/10">
        <i class="fas fa-briefcase text-red-400 text-3xl mb-3"></i>
        <h3 class="text-lg font-semibold text-white">Portfolio</h3>
        <p class="text-gray-400 mt-1 text-sm">
            Showcase projects, update portfolio items, and manage highlights.
        </p>
    </div>

    <!-- ✅ Replaced Feedback with Tasks -->
    <div class="bg-black/40 backdrop-blur-lg p-6 rounded-2xl shadow-lg border border-white/10">
        <i class="fas fa-tasks text-yellow-400 text-3xl mb-3"></i>
        <h3 class="text-lg font-semibold text-white">Tasks</h3>
        <p class="text-gray-400 mt-1 text-sm">
            Assign, track, and manage admin tasks efficiently.
        </p>
    </div>

    <!-- Card 6 -->
    <div class="bg-black/40 backdrop-blur-lg p-6 rounded-2xl shadow-lg border border-white/10">
        <i class="fas fa-envelope-open-text text-teal-400 text-3xl mb-3"></i>
        <h3 class="text-lg font-semibold text-white">Email Campaigns</h3>
        <p class="text-gray-400 mt-1 text-sm">
            Send announcements, newsletters, and important updates.
        </p>
    </div>

</div>
<!-- =================== End Middle Content =================== -->


    <!-- =================== MacBook Dock =================== -->
    <div class="relative flex items-end space-x-6 bg-black/30 backdrop-blur-lg px-6 py-3 rounded-2xl shadow-xl">
    
          
           @php
        $dockItems = [
                 
            ['url' => '/admin/user-ai-chats', 'icon' => 'fas fa-comments', 'color' => 'text-pink-400', 'label' => 'AI Chats'],
            ['url' => '/admin/tasks', 'icon' => 'fas fa-tasks', 'color' => 'text-yellow-400', 'label' => 'Tasks'],
            ['url' => '/admin/manage-admins', 'icon' => 'fas fa-user-shield', 'color' => 'text-blue-400', 'label' => 'Admins'],

            // extracted from your cards
            ['url' => '/admin/contact-details', 'icon' => 'fas fa-envelope', 'color' => 'text-pink-400', 'label' => 'Contacts'],
            ['url' => '/admin/manage-blogs', 'icon' => 'fas fa-blog', 'color' => 'text-green-400', 'label' => 'Blogs'],
            ['url' => '/admin/manage-home', 'icon' => 'fas fa-home', 'color' => 'text-blue-400', 'label' => 'Home'],
            ['url' => '/admin/manage-services', 'icon' => 'fas fa-cogs', 'color' => 'text-purple-400', 'label' => 'Services'],
            ['url' => '/admin/manage-about', 'icon' => 'fas fa-info-circle', 'color' => 'text-yellow-400', 'label' => 'About'],
            ['url' => '/admin/manage-portfolio', 'icon' => 'fas fa-briefcase', 'color' => 'text-red-400', 'label' => 'Portfolio'],
            ['url' => '/admin/manage-terms', 'icon' => 'fas fa-file-contract', 'color' => 'text-indigo-400', 'label' => 'Terms'],
            ['url' => '/admin/manage-privacy', 'icon' => 'fas fa-shield-alt', 'color' => 'text-teal-400', 'label' => 'Privacy'],
            ['url' => '/admin/manage-og-images', 'icon' => 'fas fa-images', 'color' => 'text-orange-400', 'label' => 'OG Images'],
            ['url' => '/admin/manage-client-progress', 'icon' => 'fas fa-chart-line', 'color' => 'text-orange-400', 'label' => 'Progress'],
            ['url' => '/admin/manage-feedback', 'icon' => 'fas fa-star', 'color' => 'text-yellow-400', 'label' => 'Feedback'],
            ['url' => '/admin/send-email', 'icon' => 'fas fa-envelope-open-text', 'color' => 'text-pink-400', 'label' => 'Email'],
        ];
    @endphp

        @foreach ($dockItems as $item)
            <div class="group flex flex-col items-center">
                <a href="{{ $item['url'] }}">
                    <i class="{{ $item['icon'] }} {{ $item['color'] }} text-3xl transform group-hover:scale-125 transition-transform duration-300"></i>
                </a>
                <span class="text-white text-sm mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    {{ $item['label'] }}
                </span>
            </div>
        @endforeach
    </div>
    <!-- =================== End Dock =================== -->

</div>
<!-- =================== End Admin Home =================== -->

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>

@endsection
