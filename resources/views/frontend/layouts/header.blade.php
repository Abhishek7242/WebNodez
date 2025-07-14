<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Linkuss - Web Development & Digital Solutions')</title>
    <meta name="title" content="@yield('title', 'Linkuss - Web Development & Digital Solutions')">
    <meta name="description" content="@yield('meta_description', 'Linkuss provides professional web development, digital solutions, and IT services. Expert team delivering innovative solutions for your business needs.')">
    <meta name="keywords" content="@yield('meta_keywords', 'web development, digital solutions, IT services, software development, web design, mobile apps')">
    <meta name="author" content="Linkuss">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Linkuss - Web Development & Digital Solutions')">
    <meta property="og:description" content="@yield('meta_description', 'Linkuss provides professional web development, digital solutions, and IT services. Expert team delivering innovative solutions for your business needs.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Linkuss - Web Development & Digital Solutions')">
    <meta property="twitter:description" content="@yield('meta_description', 'Linkuss provides professional web development, digital solutions, and IT services. Expert team delivering innovative solutions for your business needs.')">
    <meta property="twitter:image" content="@yield('og_image', asset('images/og-image.jpg'))">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    <script src="{{ asset('js/dark-mode.js') }}"></script>

    <!-- Stylesheets -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about/culture.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components/blog-card.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components/faq.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chatbot.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Pusher -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="position-relative">

    <header id="header">
        <!-- Tailwind CSS Navbar -->
        <nav class=" px-6 py-4 flex justify-evenly items-center">
            <div class="navbar-logo-container">
                <a href="/">
                    <img src="{{ asset('assets/Linkuss_logo.png') }}" alt="Linkuss logo" class="navbar-logo">
                </a>
                </div>

            <ul class="navbar flex space-x-8 items-center">
                <li><a href="/" class="@yield('home', ' ') nav-links font-semibold ">Home</a></li>
                <li><a href="/blogs" class="@yield('blog', ' ') nav-links font-semibold ">Blogs</a></li>
                <li><a href="/services" class="@yield('services', ' ') nav-links font-semibold ">Services</a></li>
                <li><a href="/portfolio" class="@yield('portfolio', ' ') nav-links font-semibold ">Portfolio</a>
                </li>
                <li><a href="/about-us" class="@yield('about', ' ') nav-links font-semibold ">About Us</a></li>



            </ul>


            <div class="navbar flex items-center space-x-4">
                <button id="darkModeToggle" class="p-2 rounded-full  transition-colors duration-200">
                    <i class="fas fa-moon text-yellow-500"></i>
                </button>
                <a href="/contact-us" class=" @yield('contact', ' ') animated-button"><span>Contact Us</span></a>

            </div>

            <div id="navigation-menu" class="flex">
                <button id="darkModeMobile" class="p-2 rounded-full  transition-colors duration-200">
                    <i class="fas fa-moon text-yellow-500"></i>
                </button>
                <!-- Mobile menu button -->
                <div id="ham-icon" class="toggle">
                    <span></span>
                </div>
                <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
                    crossorigin="anonymous"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.toggle').click(function() {
                            $('.toggle').toggleClass('active');
                            $('body').toggleClass('active');


                        })
                    })
                </script>
                <ul id="mobile-nav">
                    <li class="nav-btns active"><a href="/">Home</a></li>
                    <li class="nav-btns active"><a href="/blogs">Blogs</a></li>
                    <li class="nav-btns active"><a href="/services">Services</a></li>
                    <li class="nav-btns active"><a href="/portfolio">Portfolio</a></li>
                    <li class="nav-btns"><a href="/about-us">About Us</a></li>
                    <li class="nav-btns"><a href="/contact-us">Contact Us</a></li>

                </ul>
            </div>

        </nav>

        <!-- Mobile menu -->

        <script>
            let show = false
        </script>
