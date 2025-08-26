<!-- ===== Add Task Modal ===== -->
<style>
  /* ===== Modal Styles ===== */
.new-task-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6); /* dark overlay */
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease;
}

/* Show state */
.new-task-modal.show {
  opacity: 1;
  pointer-events: auto;
}

/* Modal box */
.new-task-modal .modal {
  position: relative;
  background: #1a1a1a; /* dark background */
  color: #fff;
  width: 100%;
  max-width: 600px;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.4);
  transform: scale(0.9);
  transition: transform 0.3s ease;
}

.new-task-modal.show .modal {
  transform: scale(1);
}

/* Header */
.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.modal-header h2 {
  font-size: 1.4rem;
  font-weight: bold;
}

.modal-close {
  background: transparent;
  border: none;
  font-size: 1.8rem;
  color: #fff;
  cursor: pointer;
  transition: transform 0.2s ease;
}

.modal-close:hover {
  transform: rotate(90deg);
  color: #ff4d4d;
}

/* Subtitle */
.modal-subtitle {
  font-size: 0.9rem;
  color: #aaa;
  margin-bottom: 16px;
}

/* Body */
.modal-body {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.modal-section {
  display: flex;
  flex-direction: column;
}

.modal-section label {
  font-size: 0.9rem;
  margin-bottom: 4px;
  color: #ccc;
}

.modal-section input,
.modal-section textarea,
.modal-section select {
  background: #2a2a2a;
  color: #fff;
  border: 1px solid #444;
  border-radius: 8px;
  padding: 8px 10px;
  font-size: 0.9rem;
  outline: none;
  transition: border-color 0.2s ease;
}

.modal-section input:focus,
.modal-section textarea:focus,
.modal-section select:focus {
  border-color: #4f9cff;
}

/* Footer */
.modal-footer {
  margin-top: 18px;
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

.btn {
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 0.9rem;
  cursor: pointer;
  border: none;
  transition: background 0.3s ease;
}

.btn-primary {
  background: #4f9cff;
  color: #fff;
}

.btn-primary:hover {
  background: #1f7aff;
}

.btn-secondary {
  background: #333;
  color: #fff;
}

.btn-secondary:hover {
  background: #555;
}

</style>
<div id="addTaskModal" class="new-task-modal hidden">
  <div class="modal">
    <!-- Header -->
    <div class="modal-header">
      <h2>Add New Task</h2>
      <button class="modal-close" onclick="closeAddTaskModal()">&times;</button>
    </div>
    <p class="modal-subtitle">Fill out the form to create a new task</p>

    <!-- Body -->
    <div class="modal-body">
      <form id="addTaskForm">
        <div class="modal-section">
          <label for="taskTitle" class="block font-semibold mb-1">Title</label>
          <input type="text" id="taskTitle" name="title" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="modal-section">
          <label for="taskDescription" class="block font-semibold mb-1">Description</label>
          <textarea id="taskDescription" name="description" class="w-full px-3 py-2 border rounded" rows="3"></textarea>
        </div>

        <div class="modal-section flex gap-2">
          <div class="flex-1">
            <label for="taskAssignees" class="block font-semibold mb-1">Assignees</label>
            <input type="text" id="taskAssignees" name="assignees" class="w-full px-3 py-2 border rounded" placeholder="Comma separated">
          </div>
          <div class="flex-1">
            <label for="taskStatus" class="block font-semibold mb-1">Status</label>
            <select id="taskStatus" name="status" class="w-full px-3 py-2 border rounded">
              <option>To Do</option>
              <option>In Progress</option>
              <option>Review</option>
              <option>Done</option>
              <option>Backlog</option>
            </select>
          </div>
        </div>

        <div class="modal-section flex gap-2 mt-2">
          <div class="flex-1">
            <label for="taskPriority" class="block font-semibold mb-1">Priority</label>
            <select id="taskPriority" name="priority" class="w-full px-3 py-2 border rounded">
              <option>Low</option>
              <option>Medium</option>
              <option>High</option>
              <option>Urgent</option>
            </select>
          </div>
          <div class="flex-1">
            <label for="taskDue" class="block font-semibold mb-1">Due Date</label>
            <input type="date" id="taskDue" name="due" class="w-full px-3 py-2 border rounded">
          </div>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="modal-footer">
      <button class="btn btn-secondary" onclick="closeAddTaskModal()">Cancel</button>
      <button type="submit" form="addTaskForm" class="btn btn-primary">Add Task</button>
    </div>
  </div>
</div>

<!-- ===== Add Task Modal Script ===== -->
<script>
  
  const addTaskModal = document.getElementById('addTaskModal');

  function openAddTaskModal(){
    addTaskModal.classList.remove('hidden');
    addTaskModal.classList.add('show');
    window.addEventListener('keydown', escToCloseAddModal);
  }

  function closeAddTaskModal(){
    addTaskModal.classList.remove('show');
    setTimeout(()=> addTaskModal.classList.add('hidden'), 200);
    window.removeEventListener('keydown', escToCloseAddModal);
  }

  function escToCloseAddModal(e){ if(e.key === 'Escape') closeAddTaskModal(); }

  // Optional: Handle form submission
  document.getElementById('addTaskForm').addEventListener('submit', function(e){
    e.preventDefault();
    const formData = Object.fromEntries(new FormData(this).entries());
    console.log('New Task:', formData);
    // Here you can send data to your backend via AJAX or Laravel route
    closeAddTaskModal();
    this.reset();
  });
</script>
