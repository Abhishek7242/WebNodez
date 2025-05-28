<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default Site Title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/our-services.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/our-process.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/contact-page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/services.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/technologies.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/our-process.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/pricing.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/why-us.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/case-studies.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/design-gallery.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/work-details.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/blogs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about/culture.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components/blog-card.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components/faq.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contact-us.css') }}" rel="stylesheet">
    <link href="{{ asset('css/terms_conditions.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blogs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chatbot.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/about.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="position-relative">

    <header id="header">
        <!-- Tailwind CSS Navbar -->
        <nav class=" px-6 py-4 flex justify-evenly items-center">
            <div class="text-2xl font-bold text-green-500 cursor-default">
                WebNodez
            </div>

            <ul class="hidden md:flex space-x-8 items-center">
                <li><a href="/" class="@yield('home', ' ') nav-links font-semibold ">Home</a></li>
                <li><a href="/blogs" class="@yield('blog', ' ') nav-links font-semibold ">Blogs</a></li>
                <li><a href="/services" class="@yield('services', ' ') nav-links font-semibold ">Services</a></li>
                <li><a href="/portfolio" class="@yield('portfolio', ' ') nav-links font-semibold ">Portfolio</a>
                </li>
                           <li><a href="/about-us" class="@yield('about', ' ') nav-links font-semibold ">About Us</a></li>

          
                 
            </ul>


<div class="flex items-center space-x-4">
       <button id="darkModeToggle"
                        class="p-2 rounded-full hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-moon text-yellow-500"></i>
                    </button>
                <a href="/contact-us" class=" @yield('contact', ' ') animated-button"><span>Contact Us</span></a>
               
</div>
            <!-- Mobile menu button -->
            <div class="flex items-center space-x-4 md:hidden">
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-moon text-yellow-500"></i>
                </button>
                <button id="menu-btn" class="focus:outline-none">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile menu -->
        <ul id="menu" class="hidden bg-gray-900  px-6 py-4 space-y-4 md:hidden">
            <li><a href="index.html" class="block font-semibold">Home</a></li>
            <li><a href="services.html" class="block font-semibold">Services</a></li>
            <li><a href="portfolio.html" class="block font-semibold">Portfolio</a></li>
            <li><a href="about.html" class="block font-semibold">About Us</a></li>
            <li><a href="contact.html" class="block font-semibold">Contact Us</a></li>
        </ul>

        <script>
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('menu');

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        </script>
