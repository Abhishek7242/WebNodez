<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512"
        href="{{ asset('assets/favicon/android-chrome-512x512.png') }}">
    <title>@yield('title', 'Default Site Title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- SweetAlert2 for admin notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="position-relative">
<style>
    nav{
        z-index: 111111111111;
    }
</style>
    <header id="header">
        <!-- Tailwind CSS Navbar -->
        <nav class=" px-6 py-4 flex justify-between items-center absolute top-0">
            <div class="text-2xl font-bold text-green-500 cursor-default">
                <a href="/">
                    <img src="{{ asset('assets/Linkuss_logo.png') }}" alt="Linkuss logo" class="navbar-logo">
                </a>
            </div>



            <div class="navbar flex items-center space-x-4">
                {{-- <button id="darkModeToggle" class="p-2 rounded-full  transition-colors duration-200">
                    <i class="fas fa-moon text-yellow-500"></i>
                </button> --}}
             
            </div>

           

        </nav>

        <!-- Mobile menu -->




        {{-- Mobile navbar --}}
        {{-- <script>
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
        </script> --}}
