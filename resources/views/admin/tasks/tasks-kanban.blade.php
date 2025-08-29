

@extends('admin/tasks/app')

@section('content')
@section('title', 'Linkuss - Tasks Table')
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
<div class=" tasks-view-container rounded-xl overflow-hidden bg-white relative z-50 flex flex-col items-center justify-between h-screen overflow-scroll px-20 space-y-12 ">
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
    .tasks-view-container {
        overflow-y: scroll;
    }
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
            <a href="kanban" class="flex items-center font-bold gap-3 px-4 py-2 rounded-full border text-sm bg-gray-900 text-white">
                <i class="fas fa-th-large"></i> Kanban
            </a>
            <a href="timeline" class="flex items-center gap-3 font-bold px-4 py-2 rounded-full border text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-calendar-alt"></i> Timeline
            </a>
        </div>
    </div>



</div>


{{-- kanban --}}
@php
// Prepare tasks (add an id and sort by due)
$tasks = collect($tasks)->values()->map(function($t, $i) {
    $t['id'] = $i + 1;
    return $t;
})->sortBy('due')->values()->all();

// Kanban columns we want (order matters)
$statuses = ['Backlog', 'To Do', 'In Progress', 'Review', 'Done'];

// Grouped map for easy rendering
$grouped = collect($tasks)->groupBy('status');
@endphp

<div class="kanban-shell">
  <header class="ks-header">
    <div class="ks-left">
      <h1 class="ks-title">Project Kanban</h1>
      <p class="ks-sub">Frosted glass UI · drag, drop, filter · keyboard friendly</p>
    </div>

    <div class="ks-controls">
      <input id="kanban-search" class="ks-search" placeholder="Search tasks or assignees…" />
   
    </div>
  </header>

  <main class="kanban-board" role="list" aria-label="Kanban board">
    @foreach($statuses as $status)
      @php
        $items = $grouped->get($status, collect());
        // simple WIP example: limit "In Progress" to 3
        $wip = ($status === 'In Progress') ? 3 : 999;
      @endphp

      <section class="kanban-column" data-status="{{ $status }}" data-wip="{{ $wip }}">
        <div class="col-header">
          <div class="col-title">
            <strong>{{ $status }}</strong>
            <span class="col-count">{{ $items->count() }}</span>
          </div>
          <div class="col-wip">WIP: <span class="col-wip-num">{{ $wip === 999 ? '∞' : $wip }}</span></div>
        </div>

        <div class="kanban-list" aria-label="{{ $status }} column">
          @foreach($items as $task)
            @php
              $assignees = array_map('trim', explode(',', $task['assignees']));
              $avatars = array_map(function($name){
                $parts = preg_split('/\s+/', $name);
                return strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
              }, $assignees);
              $statusClass = match($task['status']) {
                'Done' => 's-done',
                'In Progress' => 's-progress',
                'Review' => 's-review',
                default => 's-todo',
              };
              $dueNice = \Carbon\Carbon::parse($task['due'])->format('M d');
            @endphp

            <article class="kanban-card {{ $statusClass }}" tabindex="0"
                     data-id="{{ $task['id'] }}"
                     data-status="{{ $task['status'] }}"
                     data-priority="{{ $task['priority'] }}"
                     data-due="{{ $task['due'] }}">
              <div class="card-left">
                <div class="priority-bar priority-{{ strtolower($task['priority']) }}"></div>
              </div>

              <div class="card-main">
                <div class="card-row">
                  <h3 class="card-title">{{ $task['title'] }}</h3>
                  <div class="card-meta">
                    <span class="due">{{ $dueNice }}</span>
                    <span class="pill priority-pill">{{ $task['priority'] }}</span>
                  </div>
                </div>

                <p class="card-desc">{{ $task['description'] }}</p>

                <div class="card-foot">
                  <div class="avatars">
                    @foreach(array_slice($avatars, 0, 3) as $i => $init)
                      <span class="avatar" title="{{ $assignees[$i] }}">{{ $init }}</span>
                    @endforeach
                    @if(count($avatars) > 3)
                      <span class="avatar more">+{{ count($avatars) - 3 }}</span>
                    @endif
                  </div>

                  <div class="card-actions">
                    <button class="btn-ghost btn-open" title="Open">Open</button>
                    <button class="drag-handle" title="Drag" aria-hidden="true">⋮</button>
                  </div>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      </section>
    @endforeach
  </main>
</div>


<style>
/* -------------------------
   Global + glass shell
   ------------------------- */
:root{
  --glass-strong: rgba(255,255,255,0.88);
  --muted: rgba(255,255,255,0.72);
  --glass-border: rgba(255,255,255,0.06);
  --accent: #6366f1;
}
body {
  background:
    radial-gradient(600px 300px at 10% 20%, rgba(99,102,241,0.12), transparent 10%),
    radial-gradient(500px 260px at 90% 80%, rgba(16,185,129,0.05), transparent 10%),
    linear-gradient(180deg,#071029 0%, #081022 100%);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial;
  margin: 0;
  color: #021026;
}

/* shell */
.kanban-shell {
  width: calc(100% - 48px);
  max-width: 1200px;
  margin: 28px auto;
  padding: 20px;
  border-radius: 16px;
  background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
  backdrop-filter: blur(12px) saturate(120%);
  -webkit-backdrop-filter: blur(12px) saturate(120%);
  border: 1px solid rgba(255,255,255,0.06);
  box-shadow: 0 16px 40px rgba(2,6,23,0.36);
  box-sizing: border-box;
}

/* header */
.ks-header {
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:12px;
  margin-bottom:16px;
}
.ks-left .ks-title {
  margin: 0;
  color: #fff;
  font-size: 1.18rem;
  font-weight: 700;
}
.ks-sub { margin:0; color: rgba(255,255,255,0.7); font-size:0.86rem; }

/* controls */
.ks-controls { display:flex; gap:10px; align-items:center; }
.ks-search {
  padding:9px 12px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,0.06);
  background: rgba(255,255,255,0.03);
  color: #fff;
  min-width:200px;
}
.ks-btn { padding:8px 12px; border-radius:10px; border:1px solid rgba(255,255,255,0.06); background:transparent; color:#fff; cursor:pointer; }
.ks-btn-primary { background: linear-gradient(90deg,#6d28d9,#6366f1); box-shadow: 0 8px 24px rgba(99,102,241,0.14); border:none; }

/* board */
.kanban-board {
  display:flex;
    height: calc(100vh - 160px);

  gap:18px;
  overflow-x:scroll;
  overflow-y: hidden;
  padding:12px;
  align-items:flex-start;
  scrollbar-width: thin;
}
.kanban-column {
  min-width: 280px;
  max-width: 320px;
  flex: 0 0 300px;
  background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
  border-radius: 14px;
  padding:12px;
  box-shadow: 0 8px 24px rgba(2,6,23,0.06);
  border: 1px solid rgba(255,255,255,0.03);
  box-sizing: border-box;
  display:flex;
  flex-direction:column;
  gap:10px;
}

/* column header */
.col-header { display:flex; justify-content:space-between; align-items:center; gap:8px; }
.col-title { display:flex; gap:8px; align-items:center; color:rgba(0, 0, 0, 0.92); font-weight:700; }
.col-count { background: rgba(255,255,255,0.03); padding:4px 8px; border-radius:999px; font-weight:700; color:#000000; font-size:0.86rem; }
.col-wip { font-size:0.85rem; color: rgba(255,255,255,0.62); }

/* list area */
.kanban-list {
    overflow-y: scroll;
    height: calc(100vh - 260px);
     display:flex; 
     flex-direction:column;
      gap:10px; 
      min-height:80px; 
    }

/* card */
.kanban-card {
  display:flex;
  gap:12px;
  padding:12px;
  border-radius:12px;
  background: linear-gradient(180deg, rgba(255,255,255,0.88), rgba(255,255,255,0.80));
  box-shadow: 0 8px 20px rgba(2,6,23,0.06);
  border: 1px solid rgba(255,255,255,0.72);
  transition: transform 180ms cubic-bezier(.2,.9,.2,1), box-shadow 180ms;
  cursor:grab;
  user-select:none;
}
.kanban-card:active { cursor:grabbing; }
.kanban-card:focus { outline: 3px solid rgba(99,102,241,0.18); transform: translateY(-6px); }

/* left colored priority bar */
.card-left { width:6px; flex:0 0 6px; position:relative; }
.priority-bar { position:absolute; left:0; top:0; bottom:0; width:6px; border-radius:6px; }
.priority-low { background: linear-gradient(180deg,#dbeafe,#bfdbfe); }
.priority-medium { background: linear-gradient(180deg,#e6f0ff,#c7ddff); }
.priority-high { background: linear-gradient(180deg,#ffedd5,#ffb4a2); }
.priority-urgent { background: linear-gradient(180deg,#ffd6e0,#ff7ab6); }

/* main content */
.card-main { flex:1 1 auto; display:flex; flex-direction:column; gap:8px; }
.card-row { display:flex; justify-content:space-between; align-items:flex-start; gap:8px; }
.card-title { margin:0; font-size:1rem; color:#061226; font-weight:700; }
.card-meta { display:flex; gap:8px; align-items:center; }
.due { font-size:0.86rem; color:#455569; background: rgba(15,23,42,0.04); padding:4px 8px; border-radius:999px; }
.pill { padding:5px 8px; border-radius:999px; font-weight:700; font-size:0.78rem; color:#07103a; }
.priority-pill { background: linear-gradient(90deg,#c7d2fe,#9ca3ff); }

/* description */
.card-desc { font-size:0.9rem; color:#475569; line-height:1.3; max-height:40px; overflow:hidden; }

/* footer */
.card-foot { display:flex; justify-content:space-between; align-items:center; margin-top:4px; }
.avatars { display:flex; align-items:center; gap: -8px; }
.avatar {
  width:30px; height:30px; border-radius:50%;
  display:inline-grid; place-items:center; font-weight:700; font-size:0.82rem;
  color:#fff; border:2px solid rgba(255,255,255,0.9);
  background: linear-gradient(135deg,#6366f1,#6d28d9);
  margin-left:-8px;
  box-shadow: 0 6px 16px rgba(2,6,23,0.08);
}
.avatar.more { background: linear-gradient(135deg,#e2e8f0,#c7d2fe); color:#0b1220; }

/* drag handle */
.drag-handle { background: transparent; border:none; font-size:18px; cursor:grab; color:#94a3b8; }

/* status classes (for subtle top-left dot) */
.kanban-card.s-done { box-shadow: 0 10px 30px rgba(34,197,94,0.06); }
.kanban-card.s-progress { box-shadow: 0 10px 30px rgba(59,130,246,0.06); }
.kanban-card.s-review { box-shadow: 0 10px 30px rgba(245,158,11,0.06); }
.kanban-card.s-todo { box-shadow: 0 10px 30px rgba(99,102,241,0.03); }

/* placeholder during drag */
.card-placeholder {
  border: 2px dashed rgba(99,102,241,0.12);
  border-radius:10px;
  height: 72px;
  margin: 2px 0;
  background: rgba(99,102,241,0.02);
}

/* clone while dragging */
.drag-clone {
  position: fixed;
  pointer-events:none;
  z-index: 9999;
  width: 280px;
  opacity: 0.96;
  transform: translateZ(0);
  border-radius:12px;
  transition: transform 120ms;
}

/* modal */
.kanban-modal { position:fixed; inset:0; display:none; align-items:center; justify-content:center; z-index:99999; }
.kanban-modal[aria-hidden="false"] { display:flex; }
.km-backdrop { position:absolute; inset:0; background:linear-gradient(180deg, rgba(1,6,18,0.6), rgba(1,6,18,0.8)); backdrop-filter: blur(6px); }
.km-panel { position:relative; z-index:2; width:380px; border-radius:12px; padding:14px; background: linear-gradient(180deg, #fff, #fbfdff); box-shadow:0 18px 50px rgba(2,6,23,0.5); }
.km-head { display:flex; justify-content:space-between; align-items:center; }
.km-body { display:flex; flex-direction:column; gap:8px; margin-top:12px; }
.km-body label { display:flex; flex-direction:column; gap:6px; font-size:0.86rem; color:#0b1220; }
.km-body input, .km-body select, .km-body textarea { padding:8px 10px; border-radius:8px; border:1px solid rgba(2,6,23,0.06); }
.km-foot { display:flex; gap:8px; justify-content:flex-end; margin-top:12px; }
.km-close { background:transparent; border:none; font-size:18px; cursor:pointer; }

/* responsive */
@media (max-width: 980px) {
  .kanban-shell { padding:14px; width: calc(100% - 28px); }
  .kanban-board { gap:12px; padding:10px; }
  .kanban-column { min-width: 260px; flex: 0 0 260px; max-width: 260px; }
  .drag-clone { width: 240px; }
}

@media (max-width: 620px) {
  .kanban-shell { border-radius:10px; margin:14px; }
  .kanban-board { gap:10px; }
  .kanban-column { min-width: 90%; flex: 0 0 90%; max-width: 90%; }
  .ks-controls { display:none; }
}
</style>

<script>
/* ------------------------
   Kanban interactions
   - pointer-based drag & drop (works for touch & mouse)
   - keyboard: left/right arrows move card between columns
   - create task modal (client-side)
   ------------------------ */

(function () {
  // helper
  const qs = s => document.querySelector(s);
  const qsa = s => Array.from(document.querySelectorAll(s));

  const board = qs('.kanban-board');
  const columns = qsa('.kanban-column');
  const modal = qs('#kanban-modal');
  const form = qs('#km-form');

  // Drag state
  let dragging = null;
  let originList = null;
  let placeholder = null;
  let clone = null;
  let offset = { x: 0, y: 0 };

  // Init pointer listeners on cards (delegation)
  function bindCardListeners() {
    qsa('.kanban-card').forEach(card => {
      // pointerstart
      card.addEventListener('pointerdown', onPointerDown);
      // keyboard move support
      card.addEventListener('keydown', onCardKeyDown);
      // open button
      card.querySelectorAll('.btn-open').forEach(b => {
        b.addEventListener('click', (e)=> {
          e.stopPropagation();
          alert('Open task: ' + card.querySelector('.card-title').textContent);
        });
      });
    });
  }

  function onPointerDown(e) {
    // only left button (or touch)
    if (e.button && e.button !== 0) return;
    const card = e.currentTarget;
    e.preventDefault();
    card.setPointerCapture(e.pointerId);

    dragging = card;
    originList = card.closest('.kanban-list');

    const rect = card.getBoundingClientRect();
    offset.x = e.clientX - rect.left;
    offset.y = e.clientY - rect.top;

    // create placeholder
    placeholder = document.createElement('div');
    placeholder.className = 'card-placeholder';
    placeholder.style.height = rect.height + 'px';

    // clone visual
    clone = card.cloneNode(true);
    clone.classList.add('drag-clone');
    clone.style.width = rect.width + 'px';
    clone.style.left = rect.left + 'px';
    clone.style.top = rect.top + 'px';
    document.body.appendChild(clone);

    // hide original (but keep in DOM)
    card.style.visibility = 'hidden';
    card.setAttribute('aria-grabbed', 'true');
    card.classList.add('dragging');

    // insert placeholder in original spot
    originList.insertBefore(placeholder, card.nextSibling);

    document.addEventListener('pointermove', onPointerMove);
    document.addEventListener('pointerup', onPointerUp);
    document.addEventListener('pointercancel', onPointerUp);
  }

  function onPointerMove(e) {
    if (!dragging || !clone) return;
    e.preventDefault();
    // move clone
    clone.style.left = (e.clientX - offset.x) + 'px';
    clone.style.top = (e.clientY - offset.y) + 'px';
    clone.style.transform = 'translateZ(0) scale(1.02)';

    // find target list under pointer
    const elems = document.elementsFromPoint(e.clientX, e.clientY);
    const targetList = elems.find(el => el.classList && el.classList.contains('kanban-list'));

    if (targetList) {
      // find WIP limit
      const col = targetList.closest('.kanban-column');
      const wip = parseInt(col.dataset.wip || '999', 10);
      const currentCards = targetList.querySelectorAll('.kanban-card:not(.dragging)');
      // if trying to drop into column that is full, give visual feedback
      if (currentCards.length >= wip && col !== originList.closest('.kanban-column')) {
        // show a quick pulse on column to indicate full
        col.style.animation = 'kanban-wip-shake 380ms';
        setTimeout(()=> col.style.animation = '', 400);
        return; // do not move placeholder into this column
      }
      // decide insertion position by comparing Y to each card's middle
      let inserted = false;
      const cards = Array.from(currentCards);
      for (let c of cards) {
        const r = c.getBoundingClientRect();
        const mid = r.top + r.height / 2;
        if (e.clientY < mid) {
          if (targetList.contains(placeholder) && placeholder.nextSibling === c) { inserted = true; break; }
          targetList.insertBefore(placeholder, c);
          inserted = true;
          break;
        }
      }
      if (!inserted) {
        targetList.appendChild(placeholder);
      }
    }
  }

  function onPointerUp(e) {
    if (!dragging) return;
    // place original into placeholder's parent
    const newList = placeholder && placeholder.parentElement;
    if (newList) {
      newList.insertBefore(dragging, placeholder);
    }
    // cleanup
    dragging.style.visibility = '';
    dragging.classList.remove('dragging');
    dragging.removeAttribute('aria-grabbed');

    if (clone && clone.parentElement) clone.parentElement.removeChild(clone);
    if (placeholder && placeholder.parentElement) placeholder.parentElement.removeChild(placeholder);

    // update counts & dataset
    updateColumnCounts();

    // attempt to persist change (client-side placeholder)
    try {
      const newCol = newList ? newList.closest('.kanban-column') : null;
      const newStatus = newCol ? newCol.dataset.status : dragging.dataset.status;
      if (newStatus !== dragging.dataset.status) {
        const taskId = dragging.dataset.id;
        dragging.dataset.status = newStatus;
        // visually update (status class)
        dragging.classList.remove('s-done','s-progress','s-review','s-todo');
        if (newStatus === 'Done') dragging.classList.add('s-done');
        else if (newStatus === 'In Progress') dragging.classList.add('s-progress');
        else if (newStatus === 'Review') dragging.classList.add('s-review');
        else dragging.classList.add('s-todo');

        // TODO: send a fetch() POST to persist change
        // fetch('/tasks/update-status', {method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'}, body: JSON.stringify({ id: taskId, status: newStatus })});

        // subtle success pulse
        newCol && (newCol.style.boxShadow = '0 12px 36px rgba(99,102,241,0.10)');
        setTimeout(()=> newCol.style.boxShadow = '', 420);
      }
    } catch(err) { console.warn(err); }

    // remove listeners
    document.removeEventListener('pointermove', onPointerMove);
    document.removeEventListener('pointerup', onPointerUp);
    document.removeEventListener('pointercancel', onPointerUp);

    // rebind card listeners (new elements may exist)
    bindCardListeners();
    dragging = null;
    clone = null;
    placeholder = null;
    originList = null;
  }

  // keyboard: move between columns
  function onCardKeyDown(e) {
    const card = e.currentTarget;
    if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
      e.preventDefault();
      const curCol = card.closest('.kanban-column');
      const cols = Array.from(document.querySelectorAll('.kanban-column'));
      const idx = cols.indexOf(curCol);
      const targetIdx = e.key === 'ArrowRight' ? Math.min(cols.length-1, idx+1) : Math.max(0, idx-1);
      if (targetIdx === idx) return;
      const targetCol = cols[targetIdx];
      const list = targetCol.querySelector('.kanban-list');

      // WIP check
      const wip = parseInt(targetCol.dataset.wip || '999', 10);
      const count = list.querySelectorAll('.kanban-card:not(.dragging)').length;
      if (count >= wip) {
        // flash
        targetCol.style.animation = 'kanban-wip-shake 360ms';
        setTimeout(()=> targetCol.style.animation = '', 400);
        return;
      }

      list.appendChild(card);
      updateColumnCounts();

      // persist placeholder
      card.dataset.status = targetCol.dataset.status;
      // TODO: persist via fetch
    }
  }

  // update counts shown in headers
  function updateColumnCounts() {
    qsa('.kanban-column').forEach(col => {
      const n = col.querySelectorAll('.kanban-list .kanban-card').length;
      col.querySelector('.col-count').textContent = n;
    });
  }

  // Modal: create new task (client-side)
  const openBtn = qs('#open-new');
  const kmOpen = qs('#open-new');
  const kmClose = qs('#km-close');
  const kmBackdrop = qs('#km-backdrop');
  const kmSubmit = qs('#km-submit');
  const kmCancel = qs('#km-cancel');

  function showModal(show = true) {
    modal.setAttribute('aria-hidden', show ? 'false' : 'true');
    if (show) {
      qs('#km-title').focus();
    }
  }

  openBtn.addEventListener('click', ()=> showModal(true));
  kmClose.addEventListener('click', (e)=> { e.preventDefault(); showModal(false); });
  kmBackdrop.addEventListener('click', ()=> showModal(false));
  kmCancel.addEventListener('click', (e)=> { e.preventDefault(); showModal(false); });

  kmSubmit.addEventListener('click', (e)=> {
    e.preventDefault();
    const title = qs('#km-title').value.trim() || 'Untitled';
    const assignees = qs('#km-assignees').value.trim() || '';
    const priority = qs('#km-priority').value || 'Medium';
    const due = qs('#km-due').value || new Date().toISOString().slice(0,10);
    const status = qs('#km-status').value || 'Backlog';
    const desc = qs('#km-desc').value || '';

    // create DOM card (simple)
    const newId = Date.now();
    const avatars = assignees.split(',').map(s => s.trim()).filter(Boolean).slice(0,3).map(name => {
      const p = name.split(/\s+/);
      return (p[0]?.[0] || '') + (p[1]?.[0] || '');
    });
    const dueNice = new Date(due).toLocaleDateString(undefined, { month: 'short', day: 'numeric' });

    const card = document.createElement('article');
    card.className = 'kanban-card s-todo';
    card.tabIndex = 0;
    card.setAttribute('data-id', newId);
    card.setAttribute('data-status', status);
    card.setAttribute('data-priority', priority);
    card.innerHTML = `
      <div class="card-left"><div class="priority-bar priority-${priority.toLowerCase()}"></div></div>
      <div class="card-main">
        <div class="card-row">
          <h3 class="card-title">${escapeHtml(title)}</h3>
          <div class="card-meta"><span class="due">${escapeHtml(dueNice)}</span><span class="pill priority-pill">${escapeHtml(priority)}</span></div>
        </div>
        <p class="card-desc">${escapeHtml(desc)}</p>
        <div class="card-foot">
          <div class="avatars">${avatars.map(a => `<span class="avatar">${escapeHtml(a.toUpperCase())}</span>`).join('')}</div>
          <div class="card-actions"><button class="btn-ghost btn-open">Open</button><button class="drag-handle">⋮</button></div>
        </div>
      </div>`;

    const targetCol = Array.from(qsa('.kanban-column')).find(c => c.dataset.status === status);
    const list = targetCol ? targetCol.querySelector('.kanban-list') : qs('.kanban-list');
    list.insertBefore(card, list.firstChild);

    // rebind listeners and close modal
    bindCardListeners();
    updateColumnCounts();
    showModal(false);

    // TODO: persist to server (POST)
    // fetch('/tasks/create', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'}, body: JSON.stringify({ title, assignees, priority, due, status, description:desc })});
  });

  // small escape helper to avoid HTML injection in this demo
  function escapeHtml(s){ return String(s).replace(/[&<>"']/g, function(m){ return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]); }); }

  // initial binding
  bindCardListeners();
  updateColumnCounts();

  // search filter (simple)
  const search = qs('#kanban-search');
  if (search) {
    search.addEventListener('input', (e) => {
      const q = e.target.value.trim().toLowerCase();
      qsa('.kanban-card').forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const ass = (card.querySelector('.avatars')?.textContent || '').toLowerCase();
        if (!q || title.includes(q) || ass.includes(q)) card.style.display = '';
        else card.style.display = 'none';
      });
    });
  }

  // small animations
  const styleEl = document.createElement('style');
  styleEl.textContent = `@keyframes kanban-wip-shake { 0%{ transform:translateX(0) } 25%{ transform:translateX(-6px) } 50%{ transform:translateX(6px) } 75%{ transform:translateX(-4px) } 100%{ transform:translateX(0) } }`;
  document.head.appendChild(styleEl);

})();
</script>

{{-- kanban --}}

<!-- =================== End Admin Home =================== -->




@endsection
