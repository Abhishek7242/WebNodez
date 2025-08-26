@extends('admin/layouts/main')
@section('title', 'Linkuss - Tasks Dashboard')
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
<style>
    .custom-task-link {
    background-color: #6b21a8; /* default purple (like bg-purple-700) */
    transition: background 0.3s ease;
}

.custom-task-link:hover {
    background-color: #4c1d95; /* darker purple on hover */
}

</style>
    <div class="flex justify-between">

    <!-- Sidebar -->
    <aside class="w-64 bg-black text-white p-4">
       
     <nav class="mt-6 space-y-2">

    <!-- New Task (special button) -->
   
<a href="#"
   class="custom-task-link flex justify-center items-center gap-2 p-2 rounded text-white">
   <i class="fas fa-plus"></i>
   New Task
</a>



    <!-- My Tasks -->
    <a href="#"
       class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-gray-200">
       <i class="fas fa-tasks"></i>
       My Tasks
    </a>

    <!-- Boards -->
    <a href="#"
       class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-gray-200">
       <i class="fas fa-columns"></i>
       Boards
    </a>

    <!-- Timeline -->
    <a href="#"
       class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-gray-200">
       <i class="fas fa-stream"></i>
       Timeline
    </a>

    <!-- Dashboard -->
    <a href="#"
       class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-gray-200">
       <i class="fas fa-chart-line"></i>
       Dashboard
    </a>

    <!-- Settings -->
    <a href="#"
       class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 text-gray-200">
       <i class="fas fa-cog"></i>
       Settings
    </a>
</nav>

    </aside>

    <!-- Main Content -->
        @yield('content')
    </div>

@endsection
