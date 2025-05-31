<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default Site Title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

    <link href="{{ asset('css/services/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/our-services.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/our-process.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/contact-page.css') }}" rel="stylesheet">

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

            <ul class="navbar flex space-x-8 items-center">
                <li><a href="/" class="@yield('home', ' ') nav-links font-semibold ">Home</a></li>
                <li><a href="/blogs" class="@yield('blog', ' ') nav-links font-semibold ">Blogs</a></li>
                <li><a href="/services" class="@yield('services', ' ') nav-links font-semibold ">Services</a></li>
                <li><a href="/portfolio" class="@yield('portfolio', ' ') nav-links font-semibold ">Portfolio</a>
                </li>
                <li><a href="/about-us" class="@yield('about', ' ') nav-links font-semibold ">About Us</a></li>



            </ul>


            <div class="navbar flex items-center space-x-4">
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-moon text-yellow-500"></i>
                </button>
                <a href="/contact-us" class=" @yield('contact', ' ') animated-button"><span>Contact Us</span></a>

            </div>
            
            <div id="navigation-menu">

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
                    <li class="nav-btns active"><a href="/">Blogs</a></li>
                    <li class="nav-btns active"><a href="/">Services</a></li>
                    <li class="nav-btns active"><a href="/">Portfolio</a></li>
                    <li class="nav-btns"><a href="/about-us">About Us</a></li>
                    <li class="nav-btns"><a href="/contact-us">Contact Us</a></li>

                </ul>
            </div>

        </nav>

        <!-- Mobile menu -->


     

        {{-- Mobile navbar --}}
        <script>
            // MOBILE NAVBAR
            let hamIcon = document.getElementById('ham-icon')
            let mobileNav = document.getElementById('mobile-nav')
            const navItems = document.querySelectorAll('#mobile-nav .nav-btns');
            hamIcon.addEventListener('click', () => {
                mobileNav.classList.add('show')

            })
            let show = false
            hamIcon.addEventListener('click', function() {
                if (!show) {
                    document.body.classList.add('no-scroll')
                    show = true
                    mobileNav.style.right = '0px'
                    navItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.add('animate');
                        }, index * 200); // Adjust the delay as needed
                    });
                } else {
                    
                    show = false
                    navItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.remove('animate');
                        }, index * 200); // Adjust the delay as needed
                        
                    });
                    setTimeout(() => {
                        document.body.classList.remove('no-scroll')


                        hamIcon.style.opacity = "1"
                        mobileNav.classList.remove('show')
                        setTimeout(() => {
                            mobileNav.style.right = '-1000px'

                        }, 600);
                    }, 1100);
                }

                // Trigger the mobileNav animation after the last li animation

            });








            // MOBILE NAVBAR
        </script>
