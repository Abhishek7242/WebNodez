@php
  // Example admins list (replace with real $admins from controller)
  $adminsList = $admins ?? ['1' => 'Maya', '2' => 'John', '3' => 'Alex', '4' => 'Sophia', '5' => 'Emma'];
@endphp

<!-- ===== Add Task Modal ===== -->
<style>
/* ---------- modal shell ---------- */
.new-task-modal {
  position: fixed;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(3,8,18,0.62);
  z-index: 9999;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.26s ease, visibility 0.26s;
}
.new-task-modal.show { opacity: 1; pointer-events: auto; }

/* modal card */
.new-task-modal .modal {
  width: 100%;
  max-width: 640px;
  border-radius: 14px;
  padding: 20px;
  background: linear-gradient(180deg, rgba(26,26,26,0.96), rgba(20,20,20,0.94));
  box-shadow: 0 20px 60px rgba(2,6,23,0.6);
  color: #fff;
  transform: translateY(0);
  transition: transform 0.18s ease;
}

/* header */
.modal-header { display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:8px; }
.modal-header h2 { margin:0; font-size:1.25rem; letter-spacing:-0.2px; }
.modal-close { background:transparent; border:none; color:#fff; font-size:20px; cursor:pointer; }

/* subtitle */
.modal-subtitle { color: #bfc6d0; font-size:0.88rem; margin-bottom:14px; }

/* body layout */
.modal-body { display:flex; flex-direction:column; gap:12px; }
.modal-section { display:flex; flex-direction:column; gap:6px; }
.modal-section label { color:#cbd5e1; font-size:0.88rem; }

/* form controls */
.modal-section input[type="text"],
.modal-section input[type="date"],
.modal-section textarea,
.modal-section select {
  background: #141416;
  border: 1px solid rgba(255,255,255,0.06);
  color: #e6eef8;
  padding: 10px 12px;
  border-radius: 10px;
  outline: none;
  font-size: 0.95rem;
}
.modal-section textarea { resize:vertical; min-height:72px; }

/* footer buttons */
.modal-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:8px; }
.btn { padding:9px 14px; border-radius:10px; font-weight:600; border:none; cursor:pointer; display:flex; align-items:center; gap:6px; }
.btn-primary { background: linear-gradient(90deg,#4f9cff,#2b6bff); color:#fff; }
.btn-secondary { background:transparent; border:1px solid rgba(255,255,255,0.06); color:#dfe7f7; }

/* multi-select */
.ms-container { position: relative; }
.ms-control { min-height: 44px; display:flex; align-items:center; gap:8px; padding:6px 10px; background: #101114; border-radius: 10px; border: 1px solid rgba(255,255,255,0.04); cursor: pointer; }
.ms-chips { display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
.ms-chip { display:inline-flex; gap:8px; align-items:center; padding:6px 8px; background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02)); border:1px solid rgba(255,255,255,0.03); border-radius:999px; font-weight:600; color:#e6eef8; font-size:0.86rem; }
.ms-initials { width:28px; height:28px; border-radius:50%; display:grid; place-items:center; background:linear-gradient(135deg,#6366f1,#6d28d9); color:#fff; font-weight:700; margin-left:-4px; font-size:0.82rem; }
.ms-chip button { background:transparent; border:none; color:#cbd5e1; font-weight:700; cursor:pointer; margin-left:4px; }
.ms-placeholder { color:#94a3b8; font-size:0.92rem; }
.ms-toggle { margin-left:auto; background:transparent; border:none; color:#94a3b8; font-size:16px; cursor:pointer; }
.ms-dropdown { position:absolute; left:0; right:0; margin-top:8px; background:#0d0e10; border-radius:10px; border:1px solid rgba(255,255,255,0.04); box-shadow:0 8px 30px rgba(2,6,23,0.6); max-height:260px; overflow:auto; z-index:40; padding:8px; display:none; }
.ms-dropdown.open { display:block; }
.ms-search { width:100%; padding:8px 10px; border-radius:8px; border:1px solid rgba(255,255,255,0.04); background:#0b0b0d; color:#e6eef8; margin-bottom:8px; }
.ms-list { list-style:none; margin:0; padding:0; display:block; }
.ms-item { display:flex; align-items:center; gap:10px; padding:8px; border-radius:8px; cursor:pointer; color:#e6eef8; }
.ms-item:hover { background: rgba(255,255,255,0.02); }
.ms-item input[type="checkbox"] { width:16px; height:16px; cursor:pointer; }
.ms-name { font-weight:600; }
.ms-item .ms-name-muted { color:#94a3b8; font-size:0.82rem; margin-left:auto; }
.ms-actions { display:flex; gap:8px; margin-top:8px; justify-content:flex-end; }
.ms-actions button { padding:6px 10px; border-radius:8px; border:1px solid rgba(255,255,255,0.04); background:transparent; color:#cbd5e1; cursor:pointer; font-weight:600; }

/* small screens */
@media (max-width:640px){ .new-task-modal .modal { margin:20px; max-width: 92%; } }
</style>

<div id="addTaskModal" class="new-task-modal hidden" aria-hidden="true" role="dialog" aria-modal="true">
  <div class="modal" role="document" aria-labelledby="addTaskTitle">
    <div class="modal-header">
      <h2 id="addTaskTitle">Add New Task</h2>
      <button class="modal-close" onclick="closeAddTaskModal()" aria-label="Close modal">&times;</button>
    </div>
    <p class="modal-subtitle">Create a task and assign it to one or more team members.</p>

    <div class="modal-body">
      <form id="addTaskForm">
        <div class="modal-section">
          <label for="taskTitle">Title</label>
          <input type="text" id="taskTitle" name="title" required placeholder="Task title"/>
        </div>
        <div class="modal-section">
          <label for="taskDescription">Description</label>
          <textarea id="taskDescription" name="description" placeholder="Optional details"></textarea>
        </div>

        <!-- Multi-assignee select -->
        <div class="modal-section">
          <label>Assignees</label>
          <div class="ms-container" id="assigneeSelect">
            <div class="ms-control" id="msControl" tabindex="0">
              <div class="ms-chips" id="msChips"></div>
              <div class="ms-placeholder" id="msPlaceholder">Select assignees…</div>
              <button type="button" class="ms-toggle" id="msToggle">▾</button>
            </div>
            <div class="ms-dropdown" id="msDropdown">
              <input type="text" id="msSearch" class="ms-search" placeholder="Search admins…" />
              <ul class="ms-list" id="msList">
                @foreach($adminsList as $id => $name)
                  <li class="ms-item" data-id="{{ $id }}" data-name="{{ $name }}">
                    <label style="display:flex; align-items:center; gap:10px; width:100%; cursor:pointer;">
                      <input type="checkbox" value="{{ $id }}" />
                      <span class="ms-initials">{{ strtoupper(substr($name,0,1)) }}</span>
                      <span class="ms-name">{{ $name }}</span>
                      <span class="ms-name-muted">ID: {{ $id }}</span>
                    </label>
                  </li>
                @endforeach
              </ul>
              <div class="ms-actions">
                <button type="button" id="msSelectAll">Select all</button>
                <button type="button" id="msClear">Clear</button>
              </div>
            </div>
          </div>
          <input type="hidden" id="assigneesInput" name="assignees" value="" />
          <input type="hidden" id="assigneeIdsInput" name="assignee_ids" value="" />
        </div>

        <div class="modal-section" style="display:flex; gap:10px;">
          <div style="flex:1;">
            <label>Status</label>
            <select id="taskStatus" name="status">
              <option>To Do</option>
              <option>In Progress</option>
              <option>Review</option>
              <option>Done</option>
              <option>Backlog</option>
            </select>
          </div>
          <div style="flex:1;">
            <label>Priority</label>
            <select id="taskPriority" name="priority">
              <option>Low</option>
              <option selected>Medium</option>
              <option>High</option>
              <option>Urgent</option>
            </select>
          </div>
        </div>

        <div class="modal-section">
          <label>Due Date</label>
          <input type="date" id="taskDue" name="due" />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeAddTaskModal()">Cancel</button>
          <button type="submit" class="btn btn-primary" id="addTaskSubmitBtn">
            <span id="submitText">Add Task</span>
            <span id="submitLoader" style="display:none;">
              <svg class="animate-spin h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
              </svg>
            </span>
          </button>
        </div>

        <div id="formFeedback" style="text-align:center; margin-top:8px; font-weight:600;"></div>
      </form>
    </div>
  </div>
</div>

<!-- ===== Scripts ===== -->
<script>
// Modal open/close
const addTaskModal = document.getElementById('addTaskModal');
function openAddTaskModal(){
  addTaskModal.classList.remove('hidden'); addTaskModal.classList.add('show'); addTaskModal.setAttribute('aria-hidden','false');
  setTimeout(()=> document.getElementById('taskTitle').focus(), 120);
}
function closeAddTaskModal(){
  addTaskModal.classList.remove('show'); addTaskModal.setAttribute('aria-hidden','true');
  setTimeout(()=> addTaskModal.classList.add('hidden'), 260);
}

// ----- Multi-select -----
(function(){
  const msControl = document.getElementById('msControl');
  const msToggle = document.getElementById('msToggle');
  const msDropdown = document.getElementById('msDropdown');
  const msSearch = document.getElementById('msSearch');
  const msList = document.getElementById('msList');
  const msChips = document.getElementById('msChips');
  const msPlaceholder = document.getElementById('msPlaceholder');
  const assigneesInput = document.getElementById('assigneesInput');
  const assigneeIdsInput = document.getElementById('assigneeIdsInput');
  const msSelectAll = document.getElementById('msSelectAll');
  const msClear = document.getElementById('msClear');

  function openDropdown(){ msDropdown.classList.add('open'); msSearch.value=''; filterList(''); msSearch.focus(); }
  function closeDropdown(){ msDropdown.classList.remove('open'); }
  function toggleDropdown(e){ e.stopPropagation(); msDropdown.classList.contains('open')?closeDropdown():openDropdown(); }
  msToggle.addEventListener('click', toggleDropdown);
  msControl.addEventListener('click', toggleDropdown);
  document.addEventListener('click', e=>{ if(!document.getElementById('assigneeSelect').contains(e.target)) closeDropdown(); });
  msSearch.addEventListener('input', e=>filterList(e.target.value));
  function filterList(q){ q=(q||'').trim().toLowerCase(); Array.from(msList.children).forEach(li=>{ li.style.display=li.dataset.name.toLowerCase().includes(q)?'':'none'; }); }
  Array.from(msList.querySelectorAll('.ms-item')).forEach(li=>{
    const cb = li.querySelector('input[type="checkbox"]');
    li.addEventListener('click', e=>{ if(e.target.tagName!=='INPUT') cb.checked=!cb.checked; updateSelection(); });
    li.addEventListener('keydown', e=>{ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); cb.checked=!cb.checked; updateSelection(); } });
  });
  function updateSelection(){
    const selected = Array.from(msList.querySelectorAll('input[type="checkbox"]:checked')).map(cb=>{
      const li=cb.closest('.ms-item'); return {id:cb.value,name:li.dataset.name};
    });
    msChips.innerHTML='';
    selected.forEach(s=>{
      const chip=document.createElement('span'); chip.className='ms-chip';
      chip.innerHTML=`<span class="ms-initials">${s.name.trim().slice(0,1).toUpperCase()}</span><span class="ms-chip-name">${s.name}</span>`;
      const btn=document.createElement('button'); btn.type='button'; btn.innerText='×';
      btn.addEventListener('click', e=>{ e.stopPropagation(); msList.querySelector('input[type="checkbox"][value="'+s.id+'"]').checked=false; updateSelection(); });
      chip.appendChild(btn); msChips.appendChild(chip);
    });
    msPlaceholder.style.display=selected.length?'none':'';
    assigneesInput.value = selected.map(s=>s.name).join(', ');
    assigneeIdsInput.value = selected.map(s=>s.id).join(',');
  }
  msSelectAll.addEventListener('click', ()=>{ Array.from(msList.querySelectorAll('.ms-item')).forEach(li=>{ if(li.style.display==='none') return; li.querySelector('input[type="checkbox"]').checked=true; }); updateSelection(); });
  msClear.addEventListener('click', ()=>{ Array.from(msList.querySelectorAll('input[type="checkbox"]')).forEach(cb=>cb.checked=false); updateSelection(); });
  window.__assigneeMultiSelectUpdate = updateSelection; updateSelection();
})();

// ----- Form submit with loader and feedback -----
document.getElementById('addTaskForm').addEventListener('submit', async function(e){
  e.preventDefault();
  if(window.__assigneeMultiSelectUpdate) window.__assigneeMultiSelectUpdate();

  const submitBtn = document.getElementById('addTaskSubmitBtn');
  const submitText = document.getElementById('submitText');
  const submitLoader = document.getElementById('submitLoader');
  const feedbackEl = document.getElementById('formFeedback');

  submitText.style.display='none';
  submitLoader.style.display='inline-block';
  feedbackEl.textContent='';

  const formData = new FormData(this);

  try {
    const response = await fetch("{{ route('tasks.store') }}", {
      method:"POST",
      headers:{ 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body:formData
    });

    if(!response.ok) throw new Error('Network error');
    const data = await response.json();
    feedbackEl.style.color='#4ade80';
    feedbackEl.textContent='Task created successfully!';

    setTimeout(()=>{
      this.reset(); closeAddTaskModal(); msChips.innerHTML=''; assigneesInput.value=''; assigneeIdsInput.value=''; feedbackEl.textContent='';
    }, 1200);

  } catch(err){
    feedbackEl.style.color='#f87171';
    feedbackEl.textContent='Failed to create task. Please try again.';
    console.error(err);
  } finally {
    submitText.style.display='inline';
    submitLoader.style.display='none';
  }
});
</script>
