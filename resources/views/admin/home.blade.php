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

<style>
    .admin-dashboard{
        padding-bottom: 150px; /* Space for the dock */
    }
    #dashboard-counters{
      margin: 20px 10px;
    }
    /* Grid layout */
.cards-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
    padding: 1.5rem;
}

@media (min-width: 768px) {
    .cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .cards-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Card base */
.card {
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(10px);
    padding: 1.5rem;
    border-radius: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.7);
}

/* Header */
.card-header {
    margin-bottom: 1rem;
}

.icon {
    font-size: 1.8rem;
    margin-bottom: 0.75rem;
}

.icon-blue { color: #60a5fa; }
.icon-yellow { color: #facc15; }
.icon-pink { color: #f472b6; }
.icon-green { color: #4ade80; }
.icon-purple { color: #a78bfa; }
.icon-red { color: #f87171; }

.card-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #fff;
}

.card-text {
    margin-top: 0.25rem;
    font-size: 0.9rem;
    color: #9ca3af;
}

/* Footer */
.card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 1rem;
}

.card-meta {
    color: #fff;
    font-weight: bold;
}

/* Buttons */
.btn {
    padding: 0.5rem 1rem;
    border-radius: 0.75rem;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.4);
}

.btn:hover {
    transform: scale(1.05);
}

.btn-blue { background: #3b82f6; color: #fff; }
.btn-blue:hover { background: #2563eb; }

.btn-yellow { background: #facc15; color: #000; }
.btn-yellow:hover { background: #eab308; }

.btn-pink { background: #f472b6; color: #000; }
.btn-pink:hover { background: #ec4899; }

.btn-green { background: #4ade80; color: #000; }
.btn-green:hover { background: #22c55e; }

.btn-purple { background: #a78bfa; color: #000; }
.btn-purple:hover { background: #8b5cf6; }

.btn-red { background: #f87171; color: #000; }
.btn-red:hover { background: #ef4444; }

  
</style>
<!-- =================== Admin Home =================== -->
<div class="admin-dashboard relative z-50 flex flex-col items-center justify-between py-12 space-y-12">
@php
    $hour = now()->hour;
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');
    // optional counts (pass these from controller or use placeholders)
    $newTasks = $newTasks ?? 8;
    $unreadMessages = $unreadMessages ?? 5;
    $activeProjects = $activeProjects ?? 12;
@endphp

<div class="welcome-container text-center max-w-5xl mx-auto px-6">
    <p class="text-sm text-accent/80 mb-2">{{ $greeting }}, {{ Auth::user()->name ?? 'Admin' }}.</p>

    <h1 class="welcome-title text-3xl md:text-4xl font-extrabold leading-tight">
        Your command center is ready.
        <span class="block text-accent">Take control of your digital empire.</span>
    </h1>

    <p class="welcome-subtitle mt-4 text-base md:text-lg text-white/80 max-w-3xl mx-auto">
        Quick access to content, clients, operations and growth modules — everything you need to manage, monitor and move faster.
    </p>

 <div id="dashboard-counters" class="mt-6 m-6 flex flex-wrap gap-4 text-sm text-white/80">
    <span class="flex-1 min-w-[200px] px-3 py-2 bg-white/5 rounded-lg">
        🗂 Active Projects: <strong class="ml-2 text-white">{{ $activeProjects }}</strong>
    </span>
    <span class="flex-1 min-w-[200px] px-3 py-2 bg-white/5 rounded-lg">
        ✅ New Tasks: <strong class="ml-2 text-white">{{ $newTasks }}</strong>
    </span>
    <span class="flex-1 min-w-[200px] px-3 py-2 bg-white/5 rounded-lg">
        ✉️ Messages: <strong class="ml-2 text-white">{{ $unreadMessages }}</strong>
    </span>
</div>

 <!-- =================== Modern Apple-like Middle Content =================== -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl w-full">

  <!-- Card: User Management -->
  <div class="apple-card flex flex-col justify-between">
    <div class="flex items-start space-x-4">
      <div class="card-icon">
        <i class="fas fa-users"></i>
      </div>
      <div>
        <h4 class="card-title">User Management</h4>
        <p class="card-desc">View, edit, and manage registered users, roles, and permissions.</p>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <div>
        <div class="card-count">{{ $usersCount ?? '1,245' }}</div>
        <div class="card-sub">Total users</div>
      </div>
      <a href="/admin/user-ai-chats" class="card-btn">Open</a>
    </div>
  </div>

  <!-- Card: Tasks -->
  <div class="apple-card flex flex-col justify-between">
    <div class="flex items-start space-x-4">
      <div class="card-icon">
        <i class="fas fa-tasks"></i>
      </div>
      <div>
        <h4 class="card-title">Tasks</h4>
        <p class="card-desc">Assign, track and complete admin tasks efficiently.</p>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <div>
        <div class="card-count">{{ $newTasks ?? '8' }}</div>
        <div class="card-sub">New tasks</div>
      </div>
      <a href="/admin/managetasks/dashboard" class="card-btn">Open</a>
    </div>
  </div>

  <!-- Card: Messages -->
  <div class="apple-card flex flex-col justify-between">
    <div class="flex items-start space-x-4">
      <div class="card-icon">
        <i class="fas fa-envelope"></i>
      </div>
      <div>
        <h4 class="card-title">Messages</h4>
        <p class="card-desc">Incoming messages from clients and visitors.</p>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <div>
        <div class="card-count">{{ $unreadMessages ?? '5' }}</div>
        <div class="card-sub">Unread</div>
      </div>
      <a href="/admin/contact-details" class="card-btn">Open</a>
    </div>
  </div>

  <!-- Card: Blogs -->
  <div class="apple-card flex flex-col justify-between">
    <div class="flex items-start space-x-4">
      <div class="card-icon">
        <i class="fas fa-blog"></i>
      </div>
      <div>
        <h4 class="card-title">Content & Blogs</h4>
        <p class="card-desc">Publish articles, curate featured posts and drafts.</p>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <div>
        <div class="card-count">{{ $pendingPosts ?? '3' }}</div>
        <div class="card-sub">Pending posts</div>
      </div>
      <a href="/admin/manage-blogs" class="card-btn">Open</a>
    </div>
  </div>

  <!-- Card: Services -->
  <div class="apple-card flex flex-col justify-between">
    <div class="flex items-start space-x-4">
      <div class="card-icon">
        <i class="fas fa-cogs"></i>
      </div>
      <div>
        <h4 class="card-title">Services</h4>
        <p class="card-desc">Update service pages, pricing and availability.</p>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <div>
        {{-- <div class="card-count">{{ $activeServices ?? '12' }}</div> --}}
        {{-- <div class="card-sub">Active services</div> --}}
      </div>
      <a href="/admin/manage-services" class="card-btn">Open</a>
    </div>
  </div>

  <!-- Card: Portfolio -->
  <div class="apple-card flex flex-col justify-between">
    <div class="flex items-start space-x-4">
      <div class="card-icon">
        <i class="fas fa-briefcase"></i>
      </div>
      <div>
        <h4 class="card-title">Portfolio</h4>
        <p class="card-desc">Showcase projects and manage highlights.</p>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <div>
        {{-- <div class="card-count">{{ $projectsCount ?? '24' }}</div> --}}
        {{-- <div class="card-sub">Projects</div> --}}
      </div>
      <a href="/admin/manage-portfolio" class="card-btn">Open</a>
    </div>
  </div>

</div>
<!-- =================== End Modern Apple-like Middle Content =================== -->

<!-- =================== Apple-like Glass CSS =================== -->
<style>
/* Container helpers (already using Tailwind for grid) */

/* Apple-like card base */
.apple-card{
  background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));
  border: 1px solid rgba(255,255,255,0.06);
  border-radius: 16px;
  padding: 1.25rem;
  backdrop-filter: blur(10px) saturate(120%);
  -webkit-backdrop-filter: blur(10px) saturate(120%);
  transition: transform .28s cubic-bezier(.2,.9,.2,1), box-shadow .28s;
  box-shadow: 0 6px 18px rgba(2,6,23,0.5);
  min-height: 140px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative;
  overflow: hidden;
}

/* subtle inner highlight line across the top */
.apple-card::after{
  content: "";
  position: absolute;
  inset: 0 0 auto 0;
  height: 1px;
  background: linear-gradient(90deg, rgba(255,255,255,0.02), rgba(255,255,255,0.06), rgba(255,255,255,0.02));
  pointer-events: none;
}

/* Hover lift & soft glow */
.apple-card:hover{
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(10,15,25,0.6), 0 2px 8px rgba(0, 160, 255, 0.04);
  border-color: rgba(255,255,255,0.09);
}

/* Icon circle */
.card-icon{
  width: 48px;
  height: 48px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
  border: 1px solid rgba(255,255,255,0.04);
  color: #9fe7ff;
  font-size: 1.1rem;
  box-shadow: inset 0 -2px 6px rgba(0,0,0,0.35);
}

/* Title and description */
.card-title{
  font-size: 1rem;
  font-weight: 600;
  color: rgba(255,255,255,0.95);
  margin-bottom: 0.125rem;
}
.card-desc{
  font-size: 0.875rem;
  color: rgba(255,255,255,0.65);
  margin-top: 3px;
}

/* Counts */
.card-count{
  font-size: 1.6rem;
  font-weight: 700;
  color: #fff;
  letter-spacing: -0.02em;
}
.card-sub{
  font-size: 0.8rem;
  color: rgba(255,255,255,0.6);
  margin-top: 2px;
}

/* Button */
.card-btn{
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: .45rem .9rem;
  border-radius: 10px;
  font-weight: 600;
  font-size: 0.9rem;
  text-decoration: none;
  color: rgba(0,0,0,0.85);
  background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(245,245,245,0.92));
  border: 1px solid rgba(6,6,6,0.06);
  box-shadow: 0 4px 10px rgba(2,6,23,0.25);
  transition: transform .18s ease, box-shadow .18s ease, opacity .18s;
}
.card-btn:hover{
  transform: translateY(-2px);
  opacity: 0.98;
}

/* Responsive tweaks */
@media (max-width: 768px){
  .card-icon{ width:44px; height:44px; font-size:1rem; }
  .card-count{ font-size:1.4rem; }
}

/* Optional subtle neon accent ring on focus (keyboard accessible) */
.card-btn:focus{
  outline: none;
  box-shadow: 0 6px 20px rgba(0,150,255,0.12);
  border-color: rgba(0,150,255,0.18);
}
</style>


</div>



@endsection
