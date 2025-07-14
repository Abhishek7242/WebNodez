<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default Site Title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="position-relative">

    <header id="header">
        <!-- Tailwind CSS Navbar -->
        <nav class=" px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-green-500 cursor-default">
                 <a href="/">
                    <img src="{{ asset('assets/Linkuss_logo.png') }}" alt="Linkuss logo" class="navbar-logo">
                </a>
            </div>

            <ul class="navbar flex space-x-8 items-center">
                <li><a href="/admin/dashboard" class="@yield('home', ' ') nav-links font-semibold ">Home</a></li>
                <li><a href="/admin/manage-blogs" class="@yield('blog', ' ') nav-links font-semibold ">Blogs</a></li>
                <li><a href="/admin/manage-services" class="@yield('services', ' ') nav-links font-semibold ">Services</a>
                </li>
                <li><a href="/admin/manage-portfolio" class="@yield('portfolio', ' ') nav-links font-semibold ">Portfolio</a>
                </li>



            </ul>


            <div class="navbar flex items-center space-x-4">
                {{-- <button id="darkModeToggle" class="p-2 rounded-full  transition-colors duration-200">
                    <i class="fas fa-moon text-yellow-500"></i>
                </button> --}}
                <div class="relative group">
                    <button
                        class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white font-semibold hover:bg-green-600 transition-colors duration-200">
                        {{ substr(auth()->guard('admin')->user()->name ?? 'A', 0, 1) }}
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 hidden group-hover:block z-50">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ auth()->guard('admin')->user()->name ?? 'Admin User' }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                {{ auth()->guard('admin')->user()->email }}
                            </div>
                            <div class="mt-2">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ auth()->guard('admin')->user()->role === 'super_admin' ? 'bg-purple-500/20 text-purple-400' : (auth()->guard('admin')->user()->role === 'admin' ? 'bg-blue-500/20 text-blue-400' : 'bg-yellow-500/20 text-yellow-400') }}">
                                    {{ ucfirst(str_replace('_', ' ', auth()->guard('admin')->user()->role)) }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('admin.password.change') }}"
                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-key mr-2"></i>
                            Change Password
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="navigation-menu" class="flex">
                {{-- <button id="darkModeMobile" class="p-2 rounded-full  transition-colors duration-200">
                    <i class="fas fa-moon text-yellow-500"></i>
                </button> --}}
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
                    <li class="nav-btns active"><a href="/admin/dashboard">Home</a></li>
                    <li class="nav-btns active"><a href="/admin/manage-blogs">Blogs</a></li>
                    <li class="nav-btns active"><a href="/admin/manage-services">Services</a></li>
                    <li class="nav-btns active"><a href="/admin/manage-portfolio">Portfolio</a></li>
                    <li class="nav-btns"><a href="/admin/manage-about">About Us</a></li>

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



            setInterval(() => {
                console.log('heartbeat ')
                fetch('/admin/heartbeat', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                });
            }, 60000); // Every 60 seconds




            // MOBILE NAVBAR
        </script>
