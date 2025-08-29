

@extends('admin/tasks/app')

@section('content')
@section('title', 'Linkuss - Tasks Timeline')
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
            <a href="dashboard" class="flex font-bold items-center gap-3 px-4 py-2 rounded-full border text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>
            <a href="table" class="flex items-center gap-3 font-bold px-4 py-2 rounded-full border text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-table"></i> Table
            </a>
            <a href="kanban" class="flex items-center gap-3 font-bold px-4 py-2 rounded-full border text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-th-large"></i> Kanban
            </a>
            <button class="flex items-center font-bold gap-3 px-4 py-2 rounded-full border text-sm bg-gray-900 text-white">
                <i class="fas fa-calendar-alt"></i> Timeline
            </button>
        </div>
    </div>



</div>




<!-- Custom CSS -->
<style>
/* Scrollbar styling for modern, professional look */
.task-scroll::-webkit-scrollbar {
    width: 8px;
   
}

.task-scroll::-webkit-scrollbar-track {
    background: #f1f1f1; 
    border-radius: 10px;
}

.task-scroll::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #4f46e5, #6366f1);
    border-radius: 10px;
}

.task-scroll::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #4338ca, #4f46e5);
}

/* For Firefox */
.task-scroll {
    overflow-y: scroll;
    overflow-x: hidden;
    scrollbar-width: thin;
    height: calc(100vh - 250px); /* Adjust based on header/footer height */
    max-height: 100%;
    scrollbar-color: #6366f1 #f1f1f1;
}
</style>

{{-- timeline --}}
@php
// sort tasks by due date and group by month-year
$groups = collect($tasks)->sortBy('due')->groupBy(function($t){
    return \Carbon\Carbon::parse($t['due'])->format('F Y');
});
@endphp

<div class="glass-shell">
  <header class="gs-header">
    <div class="gs-title">
      <h1>Project Timeline</h1>
      <p class="gs-sub">Frosted, focused, and simple — timeline grouped by month.</p>
    </div>
  
  </header>

  <main class="timeline-viewport" role="list">
    <!-- vertical central line -->
    <div class="timeline-line" aria-hidden="true"></div>

    @foreach($groups as $month => $items)
      <div class="month-group">
        <div class="month-badge">{{ $month }}</div>

        @foreach($items as $task)
          @php
            // Assignee initials for avatars (up to 3)
            $assignees = array_map('trim', explode(',', $task['assignees']));
            $avatars = [];
            foreach($assignees as $name) {
                $parts = preg_split('/\s+/', $name);
                $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
                $avatars[] = $initials;
            }
            // status-class map
            $statusClass = match($task['status']) {
                'Done' => 's-done',
                'In Progress' => 's-progress',
                'Review' => 's-review',
                default => 's-todo',
            };
            $dueNice = \Carbon\Carbon::parse($task['due'])->format('M d, Y');
          @endphp

          <article class="timeline-item" role="listitem" tabindex="0" aria-expanded="false">
            <div class="item-left">
              <div class="date-pill">{{ $dueNice }}</div>
              <div class="dot-wrapper">
                <span class="dot {{ $statusClass }}"></span>
              </div>
            </div>

            <div class="card">
              <div class="card-row">
                <div class="card-title">
                  <h3>{{ $task['title'] }}</h3>
                  <span class="status-pill {{ $statusClass }}">{{ $task['status'] }}</span>
                </div>

                <div class="avatars">
                  @foreach(array_slice($avatars, 0, 3) as $i => $initial)
                    <span class="avatar" title="{{ $assignees[$i] }}">{{ $initial }}</span>
                  @endforeach
                </div>
              </div>

              <div class="card-sub">
                <span class="meta">📌 {{ $task['priority'] }}</span>
                <span class="meta">👥 {{ $task['assignees'] }}</span>
              </div>

              <div class="card-desc">
                <p>{{ $task['description'] }}</p>
              </div>

              {{-- <div class="card-actions">
                <button class="action-btn" onclick="event.stopPropagation(); alert('Open task: {{ addslashes($task['title']) }}')">Open</button>
                <button class="action-ghost" onclick="event.stopPropagation(); alert('Edit task: {{ addslashes($task['title']) }}')">Edit</button>
              </div> --}}
            </div>
          </article>
        @endforeach
      </div>
    @endforeach
  </main>
</div>

<style>
/* -------------------------
   Glass shell + background
   ------------------------- */
:root{
  --glass-bg: rgba(255,255,255,0.62);
  --glass-strong: rgba(255,255,255,0.78);
  --muted: #6b7280;
  --text: #0f172a;
  --accent: linear-gradient(135deg, rgba(99,102,241,0.22), rgba(99,102,241,0.06));
  --card-blur: 10px;
  --shadow: 0 8px 30px rgba(12,15,22,0.18);
  --glass-border: rgba(255,255,255,0.4);
}

/* page background (soft colorful blobs like iOS wallpapers) */
body {
  background: radial-gradient(800px 400px at 10% 10%, rgba(99,102,241,0.12), transparent 10%),
              radial-gradient(600px 300px at 90% 70%, rgba(34,197,94,0.07), transparent 10%),
              linear-gradient(180deg, #0f172a 0%, #071029 100%);
  min-height: 100vh;
  margin: 0;
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  color: var(--text);
}

/* The frosted container */
.glass-shell {
  width: calc(100% - 48px);
  max-width: 1100px;
  margin: 28px auto;
  padding: 22px;
  border-radius: 18px;
  background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
  backdrop-filter: blur(14px) saturate(120%);
  -webkit-backdrop-filter: blur(14px) saturate(120%);
  border: 1px solid rgba(255,255,255,0.06);
  box-shadow: var(--shadow);
  box-sizing: border-box;
  overflow: visible;
}

/* header */
.gs-header{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:12px;
  margin-bottom:18px;
}
.gs-title h1 {
  margin:0;
  color: #000000;
  font-size:1.3rem;
  letter-spacing: -0.2px;
}
.gs-sub {
  margin:0;
  font-size:0.85rem;
  color: rgba(0, 0, 0, 0.66);
}

/* new button (glass) */
.btn-new {
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:8px 12px;
  border-radius:999px;
  border: 1px solid rgba(0, 0, 0, 0.689);
  background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
  color: #0000008f;
  font-weight:600;
  cursor:pointer;
  backdrop-filter: blur(6px);
}
.btn-new:hover {
  background: linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0.04));
  color: #000000;
  box-shadow: 0 8px 24px rgba(2,6,23,0.12);
}
.btn-new svg { color: #fff; transform: translateY(-1px); }

/* timeline viewport */
.timeline-viewport {
    overflow-y: scroll;
    height: calc(100vh - 380px); /* Adjust based on header/footer height */
  position:relative;
  padding: 18px 14px 30px 14px;
}

/* central vertical timeline line */
.timeline-line {
  position:absolute;
  left: 160px;
  top: 0;
  bottom: 0;
  width: 2px;
  margin-left: -1px;
  background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));
  filter: blur(0.2px);
  z-index: 1;
}

/* month group + badge */
.month-group {
  margin-bottom: 28px;
  position:relative;
  z-index: 2;
}
.month-badge {
  display:inline-block;
  margin-left: 10px;
  padding: 6px 12px;
  border-radius: 999px;
  background: rgba(255,255,255,0.04);
  color: rgba(255,255,255,0.9);
  font-weight: 700;
  font-size: 0.9rem;
  border: 1px solid rgba(255,255,255,0.03);
  backdrop-filter: blur(6px);
  margin-bottom: 12px;
}

/* each timeline item (aligned to the left of line) */
.timeline-item {
  display:flex;
  gap:18px;
  padding: 12px 16px;
  align-items:flex-start;
  position:relative;
  margin-left: 0;
  transform-origin: left center;
  transition: transform 220ms cubic-bezier(.2,.9,.2,1), box-shadow 220ms;
  cursor: pointer;
  z-index: 2;
}
.timeline-item:focus { outline: none; transform: translateY(-4px) scale(1.002); }

/* left column: date + dot */
.item-left {
  width: 160px;
  min-width: 160px;
  display:flex;
  flex-direction:column;
  align-items:flex-end;
  gap:12px;
  padding-right: 8px;
}
.date-pill {
  font-size: 0.82rem;
  color: rgba(255,255,255,0.8);
  background: rgba(0,0,0,0.25);
  padding:6px 10px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,0.03);
  backdrop-filter: blur(6px);
}

/* dot (on the timeline) */
.dot-wrapper {
  position:relative;
  width: 22px;
  height: 22px;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-top: -4px;
}
.dot {
  width: 14px;
  height: 14px;
  border-radius: 50%;
  box-shadow: 0 6px 16px rgba(2,6,23,0.25);
  border: 3px solid rgba(255,255,255,0.06);
  background: rgba(255,255,255,0.9);
}

/* status-specific dot colors */
.dot.s-done { background: radial-gradient(circle at 30% 25%, #bbf7d0, #16a34a); box-shadow: 0 8px 20px rgba(34,197,94,0.18); }
.dot.s-progress { background: radial-gradient(circle at 20% 20%, #bfdbfe, #2563eb); box-shadow: 0 8px 20px rgba(59,130,246,0.18); }
.dot.s-review { background: radial-gradient(circle at 20% 20%, #fef3c7, #d97706); box-shadow: 0 8px 20px rgba(245,158,11,0.16); }
.dot.s-todo { background: radial-gradient(circle at 20% 20%, #e6eef7, #94a3b8); box-shadow: 0 8px 20px rgba(99,102,241,0.06); }

/* card (glass) */
.card {
  background: linear-gradient(180deg, rgba(255,255,255,0.86), rgba(255,255,255,0.76));
  border-radius: 14px;
  padding: 12px 14px;
  width: calc(100% - 200px);
  box-shadow: 0 8px 24px rgba(2,6,23,0.08);
  border: 1px solid rgba(255,255,255,0.7);
  backdrop-filter: blur(var(--card-blur));
  transition: transform 220ms cubic-bezier(.2,.9,.2,1), box-shadow 220ms;
  color: var(--text);
}

/* hover / focus visual */
.timeline-item:hover .card,
.timeline-item:focus .card {
  transform: translateY(-6px);
  box-shadow: 0 18px 48px rgba(2,6,23,0.14);
}

/* card header row */
.card-row {
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:12px;
}
.card-title h3 {
  margin:0;
  font-size:1.02rem;
  color:#0b1220;
  letter-spacing:-0.2px;
}
.status-pill {
  padding:6px 10px;
  border-radius: 999px;
  font-weight:700;
  font-size:0.78rem;
  color: #fff;
  display:inline-block;
  box-shadow: 0 6px 14px rgba(2,6,23,0.06);
  transform: translateZ(0);
}
.status-pill.s-done { background: linear-gradient(90deg,#34d399,#16a34a); color:#05320a; }
.status-pill.s-progress { background: linear-gradient(90deg,#60a5fa,#2563eb); color:#04205a; }
.status-pill.s-review { background: linear-gradient(90deg,#fcd34d,#d97706); color:#352100; }
.status-pill.s-todo { background: linear-gradient(90deg,#c7d2fe,#9ca3ff); color:#07103a; }

/* avatars */
.avatars { display:flex; align-items:center; gap: -8px; }
.avatar {
  width:34px; height:34px; border-radius:50%;
  display:inline-grid; place-items:center;
  font-weight:700; font-size:0.85rem;
  color:#fff; border:2px solid rgba(255,255,255,0.9);
  box-shadow: 0 6px 16px rgba(2,6,23,0.12);
  background: linear-gradient(135deg, rgba(99,102,241,0.88), rgba(99,102,241,0.65));
  margin-left: -8px;
}

/* card meta + description */
.card-sub { margin-top:8px; display:flex; gap:12px; flex-wrap:wrap; align-items:center; color:var(--muted); font-size:0.88rem; }
.meta { background: rgba(15,23,42,0.02); padding:6px 8px; border-radius:8px; border:1px solid rgba(0,0,0,0.03); color:#334155; }

.card-desc { margin-top:10px; font-size:0.95rem; color:#334155; line-height:1.45; max-height:120px; overflow:hidden; }

/* actions */
.card-actions { margin-top:12px; display:flex; gap:10px; }
.action-btn {
  background: linear-gradient(90deg, rgba(34,197,94,0.12), rgba(34,197,94,0.06));
  border:1px solid rgba(34,197,94,0.12);
  padding:8px 12px; border-radius:10px; font-weight:600; cursor:pointer; color:#065f46;
}
.action-ghost {
  background: transparent; border:1px solid rgba(2,6,23,0.06); padding:8px 12px; border-radius:10px; cursor:pointer; color:#0b1220;
}

/* responsive: on narrow screens stack layout */
@media (max-width: 880px) {
  .card { width: calc(100% - 140px); }
  .avatars .avatar { width:30px; height:30px; font-size:0.78rem; margin-left:-6px; }
}

/* small screens: stack items under line */
@media (max-width: 520px) {
  .timeline-line { display:none; }
  .item-left { display:none; }
  .timeline-item { flex-direction: column; align-items:flex-start; gap:8px; padding-left:12px; }
  .card { width:100%; }
  .month-badge { margin-left: 0; margin-bottom:10px; }
}
</style>

<script>
/* small JS: a11y + expand behavior + keyboard support */
(function(){
  document.querySelectorAll('.timeline-item').forEach(item => {
    item.addEventListener('click', function(e){
      // toggle expanded (visual) — we use aria-expanded for accessibility
      const isExpanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
      this.classList.toggle('expanded');
    });

    item.addEventListener('keydown', function(e){
      if(e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        this.click();
      }
    });
  });

  // Optional: collapse all when clicking outside
  document.addEventListener('click', function(e){
    if(!e.target.closest('.timeline-item')) {
      document.querySelectorAll('.timeline-item[aria-expanded="true"]').forEach(it => {
        it.setAttribute('aria-expanded', 'false');
        it.classList.remove('expanded');
      });
    }
  });
})();
</script>


{{-- timeline --}}

<!-- =================== End Admin Home =================== -->




@endsection
