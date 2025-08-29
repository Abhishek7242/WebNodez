

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
            <button class="flex items-center font-bold gap-3 px-4 py-2 rounded-full border text-sm bg-gray-900 text-white">
                <i class="fas fa-table"></i> Table
            </button>
            <a href="kanban" class="flex items-center gap-3 font-bold px-4 py-2 rounded-full border text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-th-large"></i> Kanban
            </a>
            <a href="timeline" class="flex items-center gap-3 font-bold px-4 py-2 rounded-full border text-sm text-gray-600 hover:bg-gray-100">
                <i class="fas fa-calendar-alt"></i> Timeline
            </a>
        </div>
    </div>



</div>


<!-- resources/views/admin/tasks/tasks-dashboard.blade.php -->
<div class="task-table shadow rounded-lg border">
    <!-- Scrollable wrapper -->
    <div class="task-scroll">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-700 text-white sticky top-0 z-10">
                <tr>
                    <th class="px-4 py-2 text-left">Task</th>
                    <th class="px-4 py-2 text-left">Assignees</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Priority</th>
                    <th class="px-4 py-2 text-left">Due</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($tasks as $task)
                <tr class="border-t cursor-pointer hover:bg-gray-100 transition"
                    data-task='@json($task)'
                    onclick="openTaskModal(this)">
                    <td class="px-4 py-2 font-bold">{{ $task['title'] }}</td>
                    
                   <td class="px-4 py-2 flex -space-x-2">
    @foreach(explode(',', $task['assignees']) as $assignee)
        @php
            $assignee = trim($assignee);
            $initials = collect(explode(' ', $assignee))
                ->map(fn($word) => strtoupper($word[0]))
                ->implode('');
            $bgColors = ['bg-blue','bg-green','bg-purple','bg-pink','bg-yellow','bg-red'];
            $color = $bgColors[crc32($assignee) % count($bgColors)];
        @endphp
        <div class="avatar {{ $color }}" data-name="{{ $assignee }}">
            {{ $initials }}
        </div>
    @endforeach
</td>
<style>
  /* Avatar base */
.avatar {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    border-radius: 50%;
    border: 2px solid #fff;
    color: #fff;
    position: relative;
    cursor: pointer;
}

/* Overlap effect */
.avatar:not(:first-child) {
    margin-left: -8px;
}

/* Tooltip on hover */
.avatar::after {
    content: attr(data-name);
    position: absolute;
    bottom: -28px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.8);
    color: #fff;
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 6px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease-in-out;
}
.avatar:hover::after {
    opacity: 1;
}

/* Background colors */
.bg-blue   { background-color: #3b82f6; }
.bg-green  { background-color: #10b981; }
.bg-purple { background-color: #8b5cf6; }
.bg-pink   { background-color: #ec4899; }
.bg-yellow { background-color: #f59e0b; }
.bg-red    { background-color: #ef4444; }

</style>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full font-bold text-xs 
                            @if($task['status'] == 'In Progress') bg-yellow-100 text-yellow-700
                            @elseif($task['status'] == 'To Do') bg-blue-100 text-blue-700
                            @elseif($task['status'] == 'Backlog') bg-gray-200 text-gray-700
                            @elseif($task['status'] == 'Review') bg-purple-100 text-purple-700
                            @elseif($task['status'] == 'Done') bg-green-100 text-green-700
                            @endif">
                            {{ $task['status'] }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full font-bold text-xs
                            @if($task['priority'] == 'Urgent') bg-red-100 text-red-700
                            @elseif($task['priority'] == 'High') bg-orange-100 text-orange-700
                            @elseif($task['priority'] == 'Medium') bg-yellow-100 text-yellow-700
                            @elseif($task['priority'] == 'Low') bg-green-100 text-green-700
                            @endif">
                            {{ $task['priority'] }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($task['due'])->format('m/d/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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


<!-- Modal -->
<!-- ===== Task Modal ===== -->
<div id="taskModal" class="modal-overlay hidden">
  <div class="modal">
    <!-- Header -->
    <div class="modal-header">
      <h2 id="modalTitle"></h2>
      <button id="modalCloseBtn" class="modal-close" onclick="closeTaskModal()">&times;</button>
    </div>
    <p class="modal-subtitle">Task details</p>

    <!-- Body -->
    <div class="modal-body">
      <div class="modal-section">
        <h3>📝 Description</h3>
        <p id="modalDescription"></p>
      </div>

      <div class="modal-info">
        <div><strong>Assignees:</strong> <span id="modalAssignees"></span></div>
        <div><strong>Status:</strong> <span id="modalStatus" class="badge"></span></div>
        <div><strong>Priority:</strong> <span id="modalPriority" class="badge"></span></div>
        <div><strong>Due:</strong> <span id="modalDue"></span></div>
      </div>
    </div>

    <!-- Footer -->
    <div class="modal-footer">
      <button class="btn btn-secondary" onclick="closeTaskModal()">Close</button>
      <button class="btn btn-primary">Edit</button>
    </div>
  </div>
</div>

<!-- ===== Modal Styles ===== -->
<style>
  /* Overlay */
  .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    display: none; /* hidden initially */
    align-items: center;
    justify-content: center;
    z-index: 100;
  }
  .modal-overlay.show { display: flex; }

  /* Modal box */
  .modal {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.25);
    width: 500px;
    max-width: 95%;
    padding: 20px 24px;
    animation: scaleIn 0.25s ease;
    position: relative;
  }

  @keyframes scaleIn {
    from { opacity: 0; transform: translateY(10px) scale(0.96); }
    to { opacity: 1; transform: translateY(0) scale(1); }
  }

  /* Header */
  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .modal-header h2 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
  }
  .modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #555;
    transition: color 0.2s;
  }
  .modal-close:hover { color: #000; }
  .modal-subtitle {
    font-size: 0.85rem;
    color: #888;
    margin-bottom: 1rem;
  }

  /* Body */
  .modal-body {
    margin-bottom: 1.5rem;
  }
  .modal-section h3 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }
  .modal-section p {
    margin: 0;
    color: #444;
    line-height: 1.4;
  }
  .modal-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem 1rem;
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #333;
  }

  /* Footer */
  .modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
    border-top: 1px solid #eee;
    padding-top: 1rem;
  }
  .btn {
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    font-size: 0.9rem;
    cursor: pointer;
    transition: background 0.2s;
  }
  .btn-primary {
    background: #2563eb;
    color: white;
  }
  .btn-primary:hover { background: #1d4ed8; }
  .btn-secondary {
    background: #f3f4f6;
    color: #111;
  }
  .btn-secondary:hover { background: #e5e7eb; }

  /* Badges */
  .badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
  }

  /* Assignee chips */
  .chip {
    display: inline-block;
    background: #f3f4f6;
    padding: 3px 8px;
    margin: 2px;
    border-radius: 9999px;
    font-size: 0.75rem;
  }
</style>

<!-- ===== Modal Script ===== -->
<script>
  function openTaskModal(rowOrTask){
    const task = rowOrTask?.dataset ? JSON.parse(rowOrTask.dataset.task) : rowOrTask;

    // Fill text fields
    setText('modalTitle', task.title ?? '');
    setText('modalDescription', task.description ?? 'No description provided');
    setText('modalDue', task.due ?? '');

    // Assignee chips
    const assigneesWrap = document.getElementById('modalAssignees');
    assigneesWrap.innerHTML = '';
    (String(task.assignees || '').split(',').map(s => s.trim()).filter(Boolean)).forEach(name=>{
      const span = document.createElement('span');
      span.className = 'chip';
      span.textContent = name;
      assigneesWrap.appendChild(span);
    });

    // Badges
    paintBadge(document.getElementById('modalStatus'), task.status, {
      'In Progress': 'bg-yellow-100 text-yellow-800 ring-yellow-200',
      'To Do':       'bg-blue-100 text-blue-800 ring-blue-200',
      'Backlog':     'bg-gray-100 text-gray-800 ring-gray-200',
      'Review':      'bg-purple-100 text-purple-800 ring-purple-200',
      'Done':        'bg-green-100 text-green-800 ring-green-200'
    });

    paintBadge(document.getElementById('modalPriority'), task.priority, {
      'Urgent': 'bg-red-100 text-red-800 ring-red-200',
      'High':   'bg-orange-100 text-orange-800 ring-orange-200',
      'Medium': 'bg-yellow-100 text-yellow-800 ring-yellow-200',
      'Low':    'bg-green-100 text-green-800 ring-green-200'
    });

    // Show
    const modal = document.getElementById('taskModal');
    modal.classList.remove('hidden');
    modal.classList.add('show');

    // Focus + Esc
    document.getElementById('modalCloseBtn').focus();
    window.addEventListener('keydown', escToClose);
  }

  function closeTaskModal(){
    const modal = document.getElementById('taskModal');
    modal.classList.remove('show');
    setTimeout(()=> modal.classList.add('hidden'), 200);
    window.removeEventListener('keydown', escToClose);
  }

  function escToClose(e){ if(e.key === 'Escape') closeTaskModal(); }

  function setText(id, val){ const el = document.getElementById(id); if(el) el.textContent = val; }
  function paintBadge(el, text, map){
    if(!el) return;
    el.className = 'badge ' + (map?.[text] || 'bg-gray-100 text-gray-700 ring-gray-200');
    el.textContent = text || '—';
  }
</script>



<!-- =================== End Admin Home =================== -->




@endsection
