@extends('admin/tasks/app')

@section('content')
@section('title', 'Linkuss - My Tasks Dashboard')
@section('my-tasks', 'active-task')
<style>
  /* iOS-like card design */
  .task-card {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(200, 200, 200, 0.4);
      transition: all 0.2s ease-in-out;
  }
  .task-card:hover {
      background: rgba(255, 255, 255, 0.95);
      transform: scale(1.01);
  }

  /* Scroll container */
  .task-list {
      max-height: calc(100vh - 220px);
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: rgba(0,0,0,0.2) transparent;
  }

  /* Modal */
  .modal-bg {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.4);
      backdrop-filter: blur(6px);
      justify-content: center;
      align-items: center;
      z-index: 50;
  }
  .modal-bg.active {
      display: flex;
  }
  .modal-content {
      background: rgba(255,255,255,0.9);
      border-radius: 16px;
      padding: 20px;
      width: 400px;
      max-width: 90%;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      animation: pop 0.2s ease-in-out;
  }
  @keyframes pop {
      from { transform: scale(0.9); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
  }
</style>

<div class="bg-white/70 backdrop-blur-xl border border-gray-200 rounded-2xl p-6 shadow-lg h-screen w-full">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-900">My Tasks</h2>
        <span class="text-xs text-gray-500">View and track your progress</span>
    </div>

    <!-- Task List -->
    <div class="task-list space-y-3 pr-1">
        @php
          // Fake tasks for demo - replace with real $tasks
          $tasks = [
            (object)['title' => 'Fix login bug', 'status' => 'To Do', 'desc'=>'Investigate failed login attempts and resolve issues.'],
            (object)['title' => 'Update dashboard UI', 'status' => 'In Progress', 'desc'=>'Redesign dashboard cards with modern glass UI.'],
            (object)['title' => 'Write weekly report', 'status' => 'Review', 'desc'=>'Summarize completed and pending tasks for the week.'],
            (object)['title' => 'Deploy to production', 'status' => 'Done', 'desc'=>'Finalize deployment process and push changes live.'],
          ];
          $colors = [
            'To Do' => 'bg-gray-200 text-gray-800',
            'In Progress' => 'bg-yellow-300 text-yellow-900',
            'Review' => 'bg-blue-300 text-blue-900',
            'Done' => 'bg-green-300 text-green-900',
          ];
        @endphp

        @foreach($tasks as $i => $task)
          <div onclick="openModal({{ $i }})" class="cursor-pointer flex items-center justify-between task-card px-4 py-3 rounded-xl shadow-sm">
              <!-- Task title -->
              <span class="text-sm font-medium text-gray-900 truncate">{{ $task->title }}</span>

              <!-- Status Badge -->
              <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $colors[$task->status] ?? 'bg-gray-300 text-gray-800' }}">
                {{ $task->status }}
              </span>
          </div>
        @endforeach
    </div>

    <!-- Footer -->
    <div class="mt-6 text-xs text-gray-500 text-center">
        Tip: Stay consistent — small progress daily adds up 🚀
    </div>
</div>

<!-- ===== Modal (hidden by default) ===== -->
<div id="taskModal" class="modal-bg">
  <div class="modal-content">
    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900"></h3>
    <p id="modalDesc" class="mt-2 text-sm text-gray-700"></p>
    <span id="modalStatus" class="mt-3 inline-block px-3 py-1 rounded-full text-xs font-semibold"></span>

    <div class="mt-4 text-right">
      <button onclick="closeModal()" class="px-4 py-2 bg-gray-800 text-white text-sm rounded-lg hover:bg-gray-700">
        Close
      </button>
      <button onclick="completedTask()" class="px-4 py-2 bg-green-800 text-white text-sm rounded-lg hover:bg-green-700">
        Task Completed
      </button>
    </div>
  </div>
</div>

<script>
  const tasks = @json($tasks);
  const colors = @json($colors);

  function openModal(index) {
      const task = tasks[index];
      document.getElementById('modalTitle').innerText = task.title;
      document.getElementById('modalDesc').innerText = task.desc;
      const status = document.getElementById('modalStatus');
      status.innerText = task.status;
      status.className = "mt-3 inline-block px-3 py-1 rounded-full text-xs font-semibold " + (colors[task.status] ?? 'bg-gray-300 text-gray-800');
      document.getElementById('taskModal').classList.add('active');
  }

  function closeModal() {
      document.getElementById('taskModal').classList.remove('active');
  }
  function completedTask() {
      alert('Are you sure you have completed the task')
      document.getElementById('taskModal').classList.remove('active');
  }
</script>

@endsection
