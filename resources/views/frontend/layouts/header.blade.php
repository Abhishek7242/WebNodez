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
    <link href="{{ asset('css/home/services.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/technologies.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contact.css') }}" rel="stylesheet">


</head>

<body class="position-relative">

    <header id="header">
        <!-- Tailwind CSS Navbar -->
        <nav class="text-white px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-green-500 cursor-default">
                WebNodez
            </div>

            <ul class="hidden md:flex space-x-8">
                <li><a href="index.html" class="@yield('home', ' ') nav-link font-semibold text-white">Home</a></li>
                <li><a href="services.html" class="@yield('services', ' ') nav-link font-semibold text-white">Services</a>
                </li>
                <li><a href="portfolio.html" class="@yield('portfolio', ' ') nav-link font-semibold text-white">Portfolio</a>
                </li>
                <li><a href="about.html" class="@yield('about', ' ') nav-link font-semibold text-white">About Us</a></li>
                <li><a href="contact.html" class="@yield('contact', ' ') nav-link font-semibold text-white">Contact</a></li>
            </ul>


            <!-- Mobile menu button -->
            <button id="menu-btn" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </nav>


        <!-- Mobile menu -->
        <ul id="menu" class="hidden bg-gray-900 text-white px-6 py-4 space-y-4 md:hidden">
            <li><a href="index.html" class="block  font-semibold">Home</a></li>
            <li><a href="services.html" class="block  font-semibold">Services</a></li>
            <li><a href="portfolio.html" class="block  font-semibold">Portfolio</a></li>
            <li><a href="about.html" class="block  font-semibold">About Us</a></li>
            <li><a href="contact.html" class="block  font-semibold">Contact</a></li>
        </ul>

        <script>
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('menu');

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        </script>
