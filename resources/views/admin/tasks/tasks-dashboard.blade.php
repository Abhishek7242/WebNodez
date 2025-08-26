@php
    $tasks = [
        ['title' => 'Design landing page hero', 'assignees' => 'Maya, John', 'status' => 'In Progress', 'priority' => 'High', 'due' => '2025-08-28', 'description' => 'Create a modern landing page hero section.'],
        ['title' => 'Implement auth (JWT)', 'assignees' => 'Alex', 'status' => 'To Do', 'priority' => 'Urgent', 'due' => '2025-08-26', 'description' => 'Implement authentication using JWT tokens.'],
        ['title' => 'Customer interviews (5)', 'assignees' => 'Sophia', 'status' => 'Backlog', 'priority' => 'Medium', 'due' => '2025-09-04', 'description' => 'Interview 5 customers for feedback.'],
        ['title' => 'QA regression suite', 'assignees' => 'Emma', 'status' => 'Review', 'priority' => 'High', 'due' => '2025-08-30', 'description' => 'Run full regression tests before release.'],
        ['title' => 'Release v1.2', 'assignees' => 'Maya, Alex', 'status' => 'Done', 'priority' => 'Low', 'due' => '2025-08-23', 'description' => 'Deploy version 1.2 to production.'],
        ['title' => 'Release v1.2', 'assignees' => 'Maya, Alex', 'status' => 'Done', 'priority' => 'Low', 'due' => '2025-08-23', 'description' => 'Deploy version 1.2 to production.'],
        ['title' => 'Release v1.2', 'assignees' => 'Maya, Alex', 'status' => 'Done', 'priority' => 'Low', 'due' => '2025-08-23', 'description' => 'Deploy version 1.2 to production.'],
        ['title' => 'Release v1.2', 'assignees' => 'Maya, Alex', 'status' => 'Done', 'priority' => 'Low', 'due' => '2025-08-23', 'description' => 'Deploy version 1.2 to production.'],
        ['title' => 'Release v1.2', 'assignees' => 'Maya, Alex', 'status' => 'Done', 'priority' => 'Low', 'due' => '2025-08-23', 'description' => 'Deploy version 1.2 to production.'],
        ['title' => 'Release v1.2', 'assignees' => 'Maya, Alex', 'status' => 'Done', 'priority' => 'Low', 'due' => '2025-08-23', 'description' => 'Deploy version 1.2 to production.'],
        ['title' => 'Release v1.2', 'assignees' => 'Maya, Alex', 'status' => 'Done', 'priority' => 'Low', 'due' => '2025-08-23', 'description' => 'Deploy version 1.2 to production.'],
    ];
@endphp

@extends('admin/tasks/app')

@section('content')
@section('title', 'Linkuss - Tasks Dashboard')
@section('dashboard', 'active-task')
<style>
    .tasks-view-container{
        width: 100%;
        padding: 20px;
    }
    thead{
        height: 60px;
    }
tbody tr {
    height: 60px;
    cursor: pointer;
    transition: all 0.2s ease; /* smooth animation */
}

tbody tr:hover {
    background-color: #f3f4f6; /* light gray */
    transform: scale(1.02);    /* slight zoom */
    box-shadow: 0 4px 12px rgba(0,0,0,0.1); /* soft shadow */
}

</style>

<!-- =================== Admin Home =================== -->
<div class=" tasks-view-container rounded-xl overflow-hidden bg-white relative z-50 flex flex-col items-center justify-between h-screen px-20 space-y-12 h-screen">
<div class="w-full h-screen">
  <div class="flex flex-col w-full gap-4 justify-between items-center bg-white px-6 py-2 rounded-t-lg shadow-sm">
<div class="flex justify-between w-full">
    <!-- Left: Title + Subtitle -->
    <div >
        <h2 class="text-xl font-semibold text-gray-900">Team Workspace</h2>
        <p class="text-sm text-gray-500">Unique, advanced PM UI — create, assign, comment, visualize.</p>
    </div>
    <!-- Right: New Task Button -->
    <div>
        <a onclick="openAddTaskModal()"
           class=" cursor-pointer flex items-center gap-2 px-4 py-2 rounded-full bg-gray-900 text-white hover:bg-gray-700 transition">
           <i class="fas fa-plus"></i> New Task
        </a>
    </div>
</div>

    <!-- Middle: Filters + View Switch -->
    <div class="flex items-center justify-start w-full mt-5 gap-4">
        <!-- Filters -->
      <div class="relative w-56" id="ios-dropdown">
  <!-- Trigger -->
  <button class="w-full px-4 py-2 rounded-2xl bg-white/70 backdrop-blur-md border border-gray-200 text-gray-700 text-sm font-medium shadow-md flex items-center justify-between focus:outline-none">
    <span id="selected">All assignees</span>
    <svg class="w-5 h-5 text-gray-500 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
    </svg>
  </button>
<style>
  .tasks-filter-dropdown {
  z-index: 11111;
 background: #ffffff68;
  backdrop-filter: blur(24px); /* same as Tailwind's backdrop-blur-xl */
  -webkit-backdrop-filter: blur(24px); /* for Safari support */
}

</style>
  <!-- Dropdown Menu -->
  <div class="tasks-filter-dropdown absolute z-20 mt-2 w-full rounded-2xl bg-white/80 backdrop-blur-xl shadow-xl border border-gray-200 hidden">
    <ul class="py-1 text-sm text-gray-700">
      <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded-xl">All assignees</button></li>
      @foreach($admins as $id => $name)
        <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded-xl" data-value="{{ $id }}">{{ $name }}</button></li>
      @endforeach
    </ul>
  </div>
</div>

<style>
/* Smooth iOS feel */
#ios-dropdown button {
  transition: all 0.2s ease-in-out;
}
#ios-dropdown button:hover {
  background-color: rgba(255,255,255,0.9);
}
#ios-dropdown .absolute {
  animation: fadeIn 0.2s ease-in-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-5px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const dropdown = document.querySelector("#ios-dropdown");
  const trigger = dropdown.querySelector("button");
  const menu = dropdown.querySelector(".absolute");
  const selected = dropdown.querySelector("#selected");

  trigger.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });

  menu.querySelectorAll("button").forEach(item => {
    item.addEventListener("click", () => {
      selected.textContent = item.textContent;
      menu.classList.add("hidden");
    });
  });

  document.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target)) {
      menu.classList.add("hidden");
    }
  });
});
</script>



     <div class="relative w-56" id="status-dropdown">
  <!-- Trigger -->
  <button class="w-full px-4 py-2 rounded-2xl bg-white/70 backdrop-blur-md border border-gray-200 text-gray-700 text-sm font-medium shadow-md flex items-center justify-between focus:outline-none">
    <span id="status-selected">All status</span>
    <svg class="w-5 h-5 text-gray-500 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <!-- Dropdown Menu -->
  <div class="tasks-filter-dropdown absolute z-20 mt-2 w-full rounded-2xl bg-white/80 backdrop-blur-xl shadow-xl border border-gray-200 hidden">
    <ul class="py-1 text-sm text-gray-700">
      <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded-xl">All status</button></li>
      <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded-xl">To Do</button></li>
      <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded-xl">In Progress</button></li>
      <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded-xl">Review</button></li>
      <li><button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded-xl">Done</button></li>
    </ul>
  </div>
</div>

<style>
/* Smooth iOS dropdown feel */
#status-dropdown button {
  transition: all 0.2s ease-in-out;
}
#status-dropdown button:hover {
  background-color: rgba(255,255,255,0.9);
}
#status-dropdown .absolute {
  animation: fadeIn 0.2s ease-in-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-5px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const dropdown = document.querySelector("#status-dropdown");
  const trigger = dropdown.querySelector("button");
  const menu = dropdown.querySelector(".absolute");
  const selected = dropdown.querySelector("#status-selected");

  trigger.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });

  menu.querySelectorAll("button").forEach(item => {
    item.addEventListener("click", () => {
      selected.textContent = item.textContent;
      menu.classList.add("hidden");
    });
  });

  document.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target)) {
      menu.classList.add("hidden");
    }
  });
});
</script>

      

        </div>
    <div class="flex justify-start w-full items-center gap-4 ">
        <!-- Filters -->
       

        <!-- View Switch Buttons -->
        <div class="flex gap-2">
            <button class="flex items-center font-bold gap-3 px-4 py-2 rounded-full border text-sm bg-gray-900 text-white">
                <i class="fas fa-chart-pie"></i> Dashboard
            </button>
            <a href="table" class="flex items-center gap-3 font-bold px-4 py-2 rounded-full border text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-table"></i> Table
            </a>
            <button class="flex items-center gap-3 font-bold px-4 py-2 rounded-full border text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-th-large"></i> Kanban
            </button>
            <a href="timeline" class="flex items-center gap-3 font-bold px-4 py-2 rounded-full border text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-calendar-alt"></i> Timeline
            </a>
        </div>
    </div>


<!-- =================== TOP STATS STRIP =================== -->
<div class="max-w-6xl px-6 w-full">

 @php
  $stats = $stats ?? [
    ['title' => 'Total Tasks', 'value' => 1, 'sub' => ''],
    ['title' => 'Done', 'value' => 0, 'sub' => ''],
    ['title' => 'In Progress', 'value' => 1, 'sub' => ''],
    ['title' => 'Overdue', 'value' => 0, 'sub' => ''],
  ];
@endphp

<!-- =================== Improved Dark/Glass Stats Strip =================== -->
<div class="iphone-stats-wrap">
  <div class="iphone-stats">
    @foreach($stats as $s)
      <div class="iphone-stat-card" role="group" aria-label="{{ $s['title'] }}">
        <div class="stat-top">
          <div class="stat-icon">
            {!! $s['icon'] ?? '<i class="fas fa-chart-line" aria-hidden="true"></i>' !!}
          </div>
          <div class="stat-title">{{ $s['title'] }}</div>
        </div>

        <div class="stat-value" data-value="{{ $s['value'] }}">
          {{ $s['value'] }}
        </div>

        @if(!empty($s['sub']))
          <div class="stat-sub">{{ $s['sub'] }}</div>
        @endif
      </div>
    @endforeach
  </div>
</div>

<style>
/* Container */
.iphone-stats-wrap{
  max-width: 1200px;
  padding: 0 16px;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
}

/* Track/container */
.iphone-stats{
  display: flex;
  gap: 14px;
  overflow-x: auto;
  padding: 14px;
  border-radius: 18px;

  /* darker glass background so text is readable */
  background: rgba(10,12,20,0.35);
  border: 1px solid rgba(255,255,255,0.04);
  box-shadow: 0 10px 30px rgba(2,6,23,0.55);
  backdrop-filter: blur(10px) saturate(120%);
  -webkit-backdrop-filter: blur(10px) saturate(120%);
}

/* Card (darker glass) */
.iphone-stat-card{
  min-width: 170px;
  flex: 0 0 170px;
  padding: 14px;
  border-radius: 12px;

  /* strong contrast background */
  background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(0,0,0,0.35));
  border: 1px solid rgba(255,255,255,0.03);

  transition: transform .25s cubic-bezier(.2,.9,.2,1), box-shadow .25s;
  position: relative;
  overflow: hidden;
  color: #000000; /* force light text */
}

/* subtle top highlight line */
.iphone-stat-card::before{
  content: "";
  position: absolute;
  left: 0;
  top: 6px;
  height: 1px;
  width: 100%;
  background: linear-gradient(90deg, rgba(255,255,255,0.02), rgba(255,255,255,0.06), rgba(255,255,255,0.02));
  pointer-events: none;
}

/* hover lift */
.iphone-stat-card:hover{
  transform: translateY(-8px);
  box-shadow: 0 24px 50px rgba(3,8,20,0.6), 0 2px 10px rgba(0,150,255,0.03);
  border-color: rgba(255,255,255,0.06);
}

/* Icon circle (accent) */
.stat-icon{
  width:44px;
  height:44px;
  border-radius:10px;
  display:flex;
  align-items:center;
  justify-content:center;
  background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
  border: 1px solid rgba(255,255,255,0.04);
  color: #5eead4; /* mint accent */
  font-size:18px;
  box-shadow: inset 0 -3px 6px rgba(0,0,0,0.35);
}

/* Layout */
.stat-top{
  display:flex;
  align-items:center;
  gap: 12px;
  margin-bottom: 6px;
}

/* Title: brighter and readable */
.stat-title{
  font-size: 13px;
  color: rgba(255,255,255,0.95);
  font-weight: 700;
  letter-spacing: -0.01em;
}

/* Big number: strong contrast */
.stat-value{
  margin-top: 8px;
  font-size: 30px;
  font-weight: 800;
  color: #000000;
  line-height: 1;
  letter-spacing: -0.02em;
  text-shadow: 0 1px 0 rgba(0,0,0,0.4);
}

/* Subtext */
.stat-sub{
  margin-top: 6px;
  font-size: 12px;
  color: rgba(255,255,255,0.65);
}

/* Scrollbar styling */
.iphone-stats::-webkit-scrollbar{ height:8px; }
.iphone-stats::-webkit-scrollbar-thumb{ background: rgba(255,255,255,0.05); border-radius:999px; }
.iphone-stats::-webkit-scrollbar-track{ background: transparent; }

/* smaller screens */
@media (max-width:520px){
  .iphone-stat-card{ min-width: 140px; padding:10px; }
  .stat-icon{ width:40px; height:40px; font-size:16px; }
  .stat-value{ font-size:22px; }
}
</style>

<!-- Optional: Count-up script (keeps the animation but you can remove) -->
<script>
  (function(){
    function animateValue(el, start, end, duration) {
      if(start === end) return el.textContent = end;
      let startTime = null;
      function step(timestamp){
        if(!startTime) startTime = timestamp;
        const progress = Math.min((timestamp - startTime) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        el.textContent = value;
        if(progress < 1) {
          window.requestAnimationFrame(step);
        } else {
          el.textContent = end;
        }
      }
      window.requestAnimationFrame(step);
    }

    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if(entry.isIntersecting){
          const vals = entry.target.querySelectorAll('.stat-value');
          vals.forEach(v => {
            const to = parseInt(v.getAttribute('data-value')) || 0;
            animateValue(v, 0, to, 900);
          });
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.25 });

    const container = document.querySelector('.iphone-stats');
    if(container) observer.observe(container);
  })();
</script>


  <!-- =================== CONTENT ROW =================== -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">


<!-- ===== Workload by Member (improved visual) ===== -->
<div class="workload-card" role="region" aria-label="Workload by Member">
  <header class="workload-header">
    <div>
      <h3 class="workload-title">Workload by Member</h3>
      <div class="workload-sub">Tasks assigned</div>
    </div>
    <div class="workload-actions">
      <a href="/admin/tasks" class="view-all">View all</a>
    </div>
  </header>

  <div class="members-list" id="membersList">
    @foreach($members as $m)
      @php $pct = max(0, min(100, (int)($m->percent ?? 0))); @endphp
      <div class="member-row" tabindex="0">
        <div class="member-left">
          @if($m->avatar)
            <img src="{{ $m->avatar }}" alt="{{ $m->name }}" class="member-avatar">
          @else
            <div class="member-avatar member-initials">{{ strtoupper(substr($m->name,0,1)) }}</div>
          @endif

          <div class="member-meta">
            <div class="member-name">{{ $m->name }}</div>
            <div class="member-small">Assigned: <strong>{{ $m->count }}</strong></div>
          </div>
        </div>

        <div class="member-right">
          <div class="member-percent">{{ $pct }}%</div>
        </div>

        <div class="progress-track" aria-hidden="true">
          <div class="progress-fill" data-target="{{ $pct }}"></div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<!-- =================== Styles (replace previous workload CSS) =================== -->
<style>
/* container card */
.workload-card{
  width:100%;
  height:340px;
  border-radius:14px;
  padding:18px;
  color: #000000;
  display:flex;
  flex-direction:column;
  gap:12px;
  background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    padding: 24px;
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
}

/* header */
.workload-header{
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
  gap:12px;
  margin-bottom:4px;
}
.workload-title{
  margin:0;
  font-size:1.05rem;
  font-weight:700;
  color: #000000;
}
.workload-sub{
  margin-top:4px;
  font-size:0.82rem;
     color: rgb(70 70 70 / 65%);
}
.workload-actions .view-all{
  text-decoration:none;
  font-size:0.85rem;
    color: rgb(70 70 70 / 65%);
  padding:6px 10px;
  border-radius:8px;
  background: rgba(255,255,255,0.02);
  border:1px solid rgba(255,255,255,0.02);
}
.workload-actions .view-all:hover{ background: rgba(255,255,255,0.03); }

/* members list */
.members-list{
  display:flex;
  flex-direction:column;
  gap:14px;
  max-height: 240px; /* adjustable */
  overflow-y:auto;
  padding-right:6px;
}

/* each member row */
.member-row{
  display:flex;
  flex-direction:column;
  gap:8px;
  padding:6px 0;
  border-top: 1px solid rgba(255,255,255,0.015);
}
.member-row:first-child{ border-top: none; }

/* top row: avatar + name and percent */
.member-left{
  display:flex;
  align-items:center;
  gap:12px;
}
.member-meta{ min-width:0; }
.member-name{
  font-size:0.95rem;
  font-weight:600;
  color:#000000;
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}
.member-small{
  font-size:0.78rem;
     color: rgb(70 70 70 / 65%);
  margin-top:3px;
}

/* avatar style: circular with soft ring */
.member-avatar, .member-initials{
  width:44px;
  height:44px;
  border-radius:50%;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  font-weight:700;
  font-size:1rem;
  border: 1px solid rgba(255,255,255,0.06);
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.02), rgba(0, 0, 0, 0.01));
  color: #9fe7ff;
  box-shadow: inset 0 -3px 8px rgba(0, 153, 255, 0.45);
}

/* percent on right of row */
.member-right{
  margin-left:auto;
  display:flex;
  align-items:center;
}
.member-percent{
  font-size:0.9rem;
  font-weight:700;
  color:#000000;
  min-width:48px;
  text-align:right;
}

/* progress track (slim) */
.progress-track{
  width:100%;
  height:8px; /* small slim bar */
  border-radius:999px;
  background: rgba(255,255,255,0.03);
  overflow:hidden;
  position:relative;
  margin-top:4px;
  border:1px solid rgba(255,255,255,0.015);
}
.progress-fill{
  width:0%;
  height:100%;
  border-radius:999px;
  background: linear-gradient(90deg, #3fd6c5, #7c3aed);
  box-shadow: 0 6px 14px rgba(124,58,237,0.10), inset 0 -2px 6px rgba(0,0,0,0.35);
  transition: width 900ms cubic-bezier(.2,.9,.2,1);
}

/* hover row highlight */
.member-row:hover{
  transform: translateY(-4px);
  transition: transform .18s ease;
}

/* scrollbar */
.members-list::-webkit-scrollbar{ width:8px; }
.members-list::-webkit-scrollbar-thumb{ background: rgba(255,255,255,0.04); border-radius:999px; }

/* small screens */
@media (max-width:640px){
  .workload-card{ padding:12px; max-width:100%; }
  .member-avatar{ width:38px; height:38px; }
  .member-percent{ min-width:40px; font-size:0.85rem;}
  .progress-track{ height:7px; }
}
</style>

<!-- =================== JS: animate fills on view =================== -->
<script>
  (function(){
    const list = document.getElementById('membersList');
    if(!list) return;
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if(entry.isIntersecting){
          const fills = list.querySelectorAll('.progress-fill');
          fills.forEach(f => {
            const t = parseInt(f.getAttribute('data-target')) || 0;
            f.style.width = t + '%';
          });
          observer.unobserve(list);
        }
      });
    }, { threshold: 0.25 });
    observer.observe(list);
  })();
</script>


    <!-- ===== AI Assistant (right) ===== -->
   <div class="ai-card">
  <div>
    <div class="ai-header">
      <h3>AI Assistant <span class="placeholder">(placeholder)</span></h3>
    </div>
    <p class="subtitle">Draft tasks, summaries, assignments</p>
    <p class="coming-soon">🚀 This feature is coming soon</p>

    <form action="" method="POST" class="form">
      @csrf
      <textarea name="prompt" rows="3"
        placeholder="e.g., Summarize blockers this week or Create tasks for website launch"></textarea>

      <div class="actions">
        <button type="submit" class="btn primary">Suggest</button>
        <button type="button" onclick="location.href='{{ url('/admin/tasks/auto-assign') }}'" class="btn secondary">
          Auto-assign
        </button>
        <div class="hint">Ctrl+Enter to submit</div>
      </div>
    </form>
  </div>

  <div class="footer">✨ Tip: AI will soon help draft tasks & balance workloads</div>
</div>

<style>
/* Container */
.ai-card {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 20px;
  padding: 24px;
  height: 340px;
  backdrop-filter: blur(20px) saturate(180%);
  -webkit-backdrop-filter: blur(20px) saturate(180%);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* Title */
.ai-header h3 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #000000;
  display: flex;
  align-items: center;
  gap: 6px;
}
.ai-header .placeholder {
  font-size: 0.8rem;
  font-weight: 400;
      color: rgb(70 70 70 / 65%);
}

/* Subtitle */
.subtitle {
  font-size: 0.9rem;
     color: rgb(70 70 70 / 65%);
  margin-top: 6px;
}

/* Coming soon */
.coming-soon {
  font-size: 0.85rem;
  margin-top: 4px;
  background: linear-gradient(90deg, #4ade80, #60a5fa, #a78bfa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-weight: 500;
}

/* Form */
.form {
  margin-top: 16px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.form textarea {
  width: 100%;
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(0, 0, 0, 0.226);
  border-radius: 14px;
  padding: 12px;
  font-size: 0.9rem;
  color: #000000;
  resize: none;
  outline: none;
  transition: 0.25s ease;
}
.form textarea:focus {
  border-color: #4ade80;
  box-shadow: 0 0 0 2px rgba(74, 222, 128, 0.3);
}

/* Buttons */
.actions {
  display: flex;
  align-items: center;
  gap: 10px;
}
.btn {
  padding: 8px 16px;
  border-radius: 12px;
  font-size: 0.85rem;
  font-weight: 500;
  transition: all 0.3s ease;
  cursor: pointer;
  border: none;
}
.btn.primary {
  background: linear-gradient(135deg, #4ade80, #22c55e);
  color: white;
  box-shadow: 0 4px 12px rgba(34,197,94,0.3);
}
.btn.primary:hover {
  opacity: 0.95;
  transform: translateY(-1px);
}
.btn.secondary {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.1);
  color: #000000;
}
.btn.secondary:hover {
  background: rgba(255,255,255,0.1);
}

/* Hint */
.hint {
  margin-left: auto;
  font-size: 0.7rem;
  color: rgba(0, 0, 0, 0.5);
}

/* Footer tip */
.footer {
  margin-top: 16px;
  font-size: 0.75rem;
  color: rgba(0, 0, 0, 0.5);
}
</style>


  </div>
</div>

<!-- =================== Custom CSS for look & feel =================== -->
<style>
  /* Base colors tweak to make glass look consistent with your theme */
  :root{
    --glass-border: rgba(255,255,255,0.06);
    --glass-bg: rgba(255,255,255,0.02);
    --card-bg: rgba(255,255,255,0.03);
  }

  /* Progress fill gradient (left-to-right) */
  .progress-fill{
    background: linear-gradient(90deg, #4fd1c5, #7c3aed);
    height:100%;
    transition: width .6s cubic-bezier(.2,.9,.2,1);
    box-shadow: inset 0 -2px 6px rgba(0,0,0,0.35);
  }

  /* container cards */
  .bg-white\/4 { background: rgba(255,255,255,0.04); }
  .bg-white\/5 { background: rgba(255,255,255,0.05); }
  .border-white\/8 { border-color: rgba(255,255,255,0.08); }

  /* subtle rounded card look */
  .rounded-xl { border-radius: 12px; }

  /* textarea placeholder darker */
  textarea::placeholder { color: rgba(0, 0, 0, 0.4); }

  /* small scrollbar for the top stats strip */
  .overflow-x-auto::-webkit-scrollbar { height: 8px; }
  .overflow-x-auto::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 999px; }

  /* responsive tweaks */
  @media (max-width: 1024px){
    .min-w-\[160px\] { min-width: 140px; }
  }
</style>


</div>





<!-- =================== End Admin Home =================== -->




@endsection
