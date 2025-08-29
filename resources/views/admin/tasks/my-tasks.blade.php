@extends('admin/tasks/app')

@section('content')
@section('title', 'Linkuss - My Tasks Dashboard')
@section('my-tasks', 'active-task')


<style>
  :root{
    --bg-start: #071029;
    --bg-end: #081022;
    --shell-bg: rgba(255,255,255,0.04);
    --glass: rgba(255,255,255,0.9);
    --muted: #7b8794;
    --accent: #6366f1;
    --success: #16a34a;
    --danger: #ef4444;
    --card-shadow: 0 14px 40px rgba(2,6,23,0.36);
    --glass-border: rgba(255,255,255,0.06);
    font-family: Inter, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  }

  /* Page background */
  body {
    margin: 0;
    background:
      radial-gradient(600px 300px at 10% 20%, rgba(99,102,241,0.08), transparent 10%),
      radial-gradient(500px 260px at 90% 80%, rgba(16,185,129,0.03), transparent 10%),
      linear-gradient(180deg, var(--bg-start), var(--bg-end));
    min-height: 100vh;
    color: #0b1220;
  }

  /* Shell */
  .kt-shell {
    width: calc(100% - 48px);
    max-width: 1100px;
    margin: 0px auto;
    padding: 20px;
    border-radius: 16px;
    background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
    backdrop-filter: blur(12px) saturate(120%);
    -webkit-backdrop-filter: blur(12px) saturate(120%);
    border: 1px solid var(--glass-border);
    box-shadow: var(--card-shadow);
    box-sizing: border-box;
  }

  /* Header */
  .kt-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:12px;
    margin-bottom:18px;
  }
  .kt-title {
    color: #fff;
    margin:0;
    font-size:1.2rem;
    font-weight:700;
    letter-spacing:-0.2px;
  }
  .kt-sub {
    color: rgba(255,255,255,0.72);
    font-size:0.88rem;
    margin-top:6px;
  }

  /* Controls row */
  .kt-controls {
    display:flex;
    gap:10px;
    align-items:center;
  }
  .kt-search {
    padding:9px 12px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,0.06);
    background: rgba(255,255,255,0.03);
    color: #fff;
    min-width:240px;
    outline: none;
  }
  .kt-select {
    padding:8px 10px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.06);
    background: rgba(255,255,255,0.03);
    color:#fff;
    outline:none;
  }
  .kt-btn {
    padding:9px 12px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(90deg,#6d28d9,#6366f1);
    color: #fff;
    font-weight:700;
    cursor:pointer;
    box-shadow: 0 8px 26px rgba(99,102,241,0.14);
  }

  /* Top stats */
  .kt-stats {
    display:flex;
    gap:10px;
    margin-top:12px;
    margin-bottom:18px;
    align-items:center;
  }
  .kt-chip {
    padding:6px 10px;
    background: rgba(255,255,255,0.04);
    color:#fff;
    border-radius:999px;
    font-weight:700;
    font-size:0.9rem;
    border:1px solid rgba(255,255,255,0.03);
  }

  /* Main content */
  .kt-main {
    display:grid;
    grid-template-columns: 1fr 320px;
    gap:18px;
  }

  /* Task list column */
  .kt-list {
    background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
    border-radius: 12px;
    padding:14px;
    max-height: calc(100vh - 200px);
    overflow:auto;
    border:1px solid rgba(255,255,255,0.03);
  }
  .kt-list .empty {
    color: var(--muted);
    padding: 28px;
    text-align:center;
  }

  /* Card */
  .kt-card {
    display:flex;
    gap:12px;
    align-items:flex-start;
    padding:12px;
    border-radius:12px;
    background: linear-gradient(180deg, rgba(255,255,255,0.92), rgba(255,255,255,0.86));
    border:1px solid rgba(255,255,255,0.7);
    box-shadow: 0 10px 28px rgba(2,6,23,0.06);
    margin-bottom:10px;
    transition: transform 180ms cubic-bezier(.2,.9,.2,1), box-shadow 180ms;
    cursor: pointer;
  }
  .kt-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(2,6,23,0.12); }

  /* Priority accent bar */
  .kt-accent {
    width:6px; height:100%;
    border-radius:6px;
    flex: 0 0 6px;
  }
  .pri-low { background: linear-gradient(180deg,#dbeafe,#bfdbfe); }
  .pri-medium { background: linear-gradient(180deg,#e6f0ff,#c7ddff); }
  .pri-high { background: linear-gradient(180deg,#ffedd5,#ffb4a2); }
  .pri-urgent { background: linear-gradient(180deg,#ffd6e0,#ff7ab6); }

  /* Card body */
  .kt-card-body { flex:1 1 auto; display:flex; flex-direction:column; gap:6px; }
  .kt-card-row { display:flex; justify-content:space-between; align-items:center; gap:12px; }
  .kt-card-title { font-size:1rem; font-weight:700; color:#071022; margin:0; }
  .kt-badges { display:flex; gap:8px; align-items:center; }
  .kt-status {
    padding:6px 9px; border-radius:999px; font-weight:700; font-size:0.78rem;
    color:#07103a; background: linear-gradient(90deg,#c7d2fe,#9ca3ff);
  }
  .kt-due {
    font-size:0.82rem;
    color:#475569;
    background: rgba(15,23,42,0.03);
    padding:4px 8px;
    border-radius:999px;
  }

  .kt-desc { color:#475569; font-size:0.92rem; line-height:1.3; max-height:44px; overflow:hidden; }

  /* avatars */
  .kt-meta {
    display:flex;
    justify-content:space-between;
    align-items:center;
  }
  .kt-avatars { display:flex; align-items:center; gap:-8px; }
  .kt-avatar {
    width:30px; height:30px; border-radius:50%; display:grid; place-items:center; font-weight:700; color:#fff;
    background: linear-gradient(135deg,#6366f1,#6d28d9);
    border:2px solid rgba(255,255,255,0.9);
    margin-left:-8px;
    box-shadow: 0 6px 16px rgba(2,6,23,0.08);
    font-size:0.82rem;
  }
  .kt-avatar.more { background: linear-gradient(135deg,#e2e8f0,#c7d2fe); color:#07103a; }

  /* right column - summary & filters */
  .kt-side {
    background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
    border-radius: 12px;
    padding:14px;
    border:1px solid rgba(255,255,255,0.03);
    height: fit-content;
    min-height: 120px;
  }
  .kt-side h4 { margin:0 0 8px 0; color: rgba(255,255,255,0.92); font-size:0.98rem; }
  .kt-stat-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; color: rgba(255,255,255,0.85); }
  .kt-progress {
    height:10px; background: rgba(255,255,255,0.06); border-radius:999px; overflow:hidden; margin-top:6px;
  }
  .kt-progress > i { display:block; height:100%; background: linear-gradient(90deg,#34d399,#16a34a); width:0%; transition: width 420ms ease; }

  /* modal */
  .kt-modal { position:fixed; inset:0; display:none; align-items:center; justify-content:center; z-index:9999; }
  .kt-modal.show { display:flex; }
  .kt-backdrop { position:absolute; inset:0; background: linear-gradient(180deg, rgba(1,6,18,0.6), rgba(1,6,18,0.8)); backdrop-filter: blur(6px); }
  .kt-modal-panel {
    position:relative; z-index:2; width:420px; max-width:94%;
    border-radius:12px; padding:16px; background: linear-gradient(180deg,#fff,#fbfdff);
    box-shadow: 0 18px 50px rgba(2,6,23,0.4);
  }
  .kt-form label { display:block; font-size:0.86rem; color:#0b1220; margin-top:8px; }
  .kt-form input, .kt-form select, .kt-form textarea {
    width:100%; padding:9px 10px; border-radius:8px; border:1px solid rgba(2,6,23,0.06); margin-top:6px;
  }
  .kt-modal-actions { display:flex; gap:8px; justify-content:flex-end; margin-top:12px; }
  .kt-btn-ghost { padding:8px 10px; border-radius:8px; border:1px solid rgba(2,6,23,0.06); background:transparent; cursor:pointer; }

  /* small helpers */
  .muted { color: var(--muted); font-size:0.9rem; }
  .small { font-size:0.82rem; }

  /* responsive */
  @media (max-width: 980px) {
    .kt-main { grid-template-columns: 1fr; }
    .kt-side { order: 2; margin-top:8px; }
  }
</style>

<div class="kt-shell h-screen " role="application" aria-label="My tasks dashboard">
  <header class="kt-header">
    <div>
      <div class="kt-title">My Tasks</div>
      <div class="kt-sub">A clear view of what's next — search, filter, update.</div>
    </div>

    <div class="kt-controls" role="region" aria-label="controls">
      <input id="ktSearch" class="kt-search" placeholder="Search tasks or assignees..." aria-label="Search tasks" />
      <select id="ktFilterStatus" class="kt-select" aria-label="Filter by status">
        <option value="">All Status</option>
        <option>To Do</option>
        <option>In Progress</option>
        <option>Review</option>
        <option>Done</option>
      </select>

      <select id="ktSort" class="kt-select" aria-label="Sort tasks">
        <option value="due_asc">Due → (soonest)</option>
        <option value="due_desc">Due → (latest)</option>
        <option value="priority">Priority</option>
      </select>

      {{-- <button id="ktNew" class="kt-btn" aria-label="New task">＋ New</button> --}}
    </div>
  </header>

  <div class="kt-stats" aria-hidden="false">
    <div class="kt-chip">Total: <span id="ktTotal">0</span></div>
    <div class="kt-chip">To Do: <span id="ktCountToDo">0</span></div>
    <div class="kt-chip">In Progress: <span id="ktCountProg">0</span></div>
    <div class="kt-chip">Review: <span id="ktCountRev">0</span></div>
    <div class="kt-chip">Done: <span id="ktCountDone">0</span></div>
  </div>

  <div class="kt-main">
    <section class="kt-list" id="ktList" aria-label="Task list">
      <!-- Cards injected by JS -->
      <div class="empty muted" id="ktEmpty">Loading tasks…</div>
    </section>

    <aside class="kt-side" aria-labelledby="sideTitle">
      <h4 id="sideTitle">Progress</h4>
      <div class="muted small">Completed ratio</div>
      <div class="kt-progress" aria-hidden="true"><i id="ktProgBar"></i></div>

      <h4 style="margin-top:12px">Quick tips</h4>
      <ul class="muted small">
        <li>Click a card to view details and mark complete.</li>
        <li>Use search to find tasks by title or assignee.</li>
        <li>Sort by due date or priority for focus.</li>
      </ul>
    </aside>
  </div>
</div>
<!-- Modal -->
<div id="ktModal" class="kt-modal" role="dialog" aria-modal="true" aria-hidden="true">
  <div class="kt-backdrop" id="ktBackdrop"></div>
  <div class="kt-modal-panel" role="document" aria-labelledby="ktModalTitle">
    <h3 id="ktModalTitle">Task</h3>

    <form id="ktForm" class="kt-form">
      @csrf

      <!-- Readonly Info -->
      <div class="kt-task-info">
        <p><strong>Title:</strong> <span id="viewTitle"></span></p>
        <p><strong>Assignees:</strong> <span id="viewAssignees"></span></p>
        <p><strong>Priority:</strong> <span id="viewPriority"></span></p>
        <p><strong>Due date:</strong> <span id="viewDue"></span></p>
        <p><strong>Description:</strong> <span id="viewDesc"></span></p>
      </div>

      <!-- Editable Fields -->
      <div class="kt-field">
        <label>Status</label>
        <select id="ktFieldStatus">
          <option>To Do</option>
          <option>In Progress</option>
          <option>Review</option>
          {{-- <option>Done</option> --}}
        </select>
      </div>

      <div class="kt-field">
        <label>Comment</label>
        <textarea id="ktFieldComment" rows="3" placeholder="Add a comment..."></textarea>
      </div>

      <div class="kt-modal-actions">
        <button id="ktClose" class="kt-btn-ghost" type="button">Cancel</button>
        <button id="ktSave" class="kt-btn" type="button">Update</button>
      </div>
    </form>
  </div>
</div>

<style>
/* ===== Backdrop ===== */
.kt-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.5);
  backdrop-filter: blur(6px);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 90;
}

/* ===== Modal Wrapper ===== */
.kt-modal {
  position: fixed;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  pointer-events: none;
  z-index: 100;
}

.kt-modal.show {
  pointer-events: auto;
}

.kt-modal.show .kt-backdrop {
  opacity: 1;
}

.kt-modal-panel {
  background: rgba(255, 255, 255, 0.12);
  backdrop-filter: blur(18px) saturate(180%);
  -webkit-backdrop-filter: blur(18px) saturate(180%);
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  width: 420px;
  max-width: 90%;
  padding: 24px;
  color: #fff;
  transform: translateY(40px);
  opacity: 0;
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  box-shadow: 0 8px 32px rgba(0,0,0,0.3);
}

.kt-modal.show .kt-modal-panel {
  transform: translateY(0);
  opacity: 1;
  z-index: 111111111;
}

/* ===== Headings ===== */
.kt-modal h3 {
  margin-bottom: 16px;
  font-size: 22px;
  font-weight: 600;
  color: #fff;
  text-align: center;
}

/* ===== Task Info (readonly) ===== */
.kt-task-info {
  font-size: 15px;
  margin-bottom: 20px;
  line-height: 1.5;
  color: rgba(255,255,255,0.85);
}

.kt-task-info strong {
  color: #fff;
}

/* ===== Fields ===== */
.kt-field {
  margin-bottom: 16px;
}

.kt-field label {
  display: block;
  font-size: 14px;
  margin-bottom: 6px;
  color: rgba(255,255,255,0.9);
}

.kt-field select,
.kt-field textarea {
  width: 100%;
  border: none;
  border-radius: 12px;
  padding: 10px 12px;
  font-size: 14px;
  outline: none;
  resize: none;
  background: rgba(255,255,255,0.15);
  color: #fff;
  transition: background 0.25s;
}

.kt-field select:focus,
.kt-field textarea:focus {
  background: rgba(255,255,255,0.25);
}

/* ===== Buttons ===== */
.kt-modal-actions {
  display: flex;
  justify-content: flex-end;
  gap: 12px;
  margin-top: 20px;
}

.kt-btn {
  padding: 10px 20px;
  background: linear-gradient(135deg, #007aff, #5ac8fa);
  border: none;
  border-radius: 14px;
  color: #fff;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s;
}

.kt-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(0, 122, 255, 0.4);
}
#ktFieldStatus option{
color: black;
}
.kt-btn-ghost {
  padding: 10px 20px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.4);
  border-radius: 14px;
  color: #fff;
  font-weight: 500;
  font-size: 14px;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
}

.kt-btn-ghost:hover {
  background: rgba(255,255,255,0.15);
}
/* To Do */
.kt-status.s-todo {
  background-color: #f0f0f0;
  color: #555;
}

/* In Progress */
.kt-status.s-progress {
  background-color: #ffeb99;
  color: #b58900;
}

/* Review */
.kt-status.s-review {
    background: linear-gradient(90deg, #c7feca, #d2ff9c);
}
  color: #004085;            /* dark blue */
}

/* Done */
.kt-status.s-done {
  background-color: #d4edda;
  color: #155724;
}

</style>

<script>
  // ---------- Data ----------
  let tasks = @json($tasks).map((t, i) => ({
    id: t.id ?? ('t' + (i + 1)),
    title: t.title ?? 'Untitled',
    status: t.status ?? 'To Do',
    desc: t.description ?? t.desc ?? '',
    assignees: t.assignees ?? '',
    priority: t.priority ?? 'Medium',
    due: t.due ?? null
  }));

  // ---------- Helpers ----------
  const $ = sel => document.querySelector(sel);
  const escapeHtml = str => String(str || "").replace(/[&<>"']/g, m => ({
    "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;"
  }[m]));

  function initials(name) {
    if (!name) return "";
    const parts = name.trim().split(/\s+/);
    return (parts[0]?.[0] || "").toUpperCase() + (parts[1]?.[0] || "").toUpperCase();
  }

  function statusBadgeClass(s) {
    switch (s) {
      case "Done": return "kt-status s-done";
      case "In Progress": return "kt-status s-progress";
      case "Review": return "kt-status s-review";
      default: return "kt-status s-todo";
    }
  }

  function priorityClass(p) {
    switch ((p || '').toLowerCase()) {
      case "urgent": return "pri-urgent";
      case "high": return "pri-high";
      case "low": return "pri-low";
      default: return "pri-medium";
    }
  }

  function statusProgress(s) {
    switch (s) {
      case "Done": return 100;
      case "Review": return 80;
      case "In Progress": return 45;
      default: return 6;
    }
  }

  // ---------- Rendering ----------
  const root = $("#ktList");
  const emptyEl = $("#ktEmpty");

  function renderList(filterText = "", filterStatus = "", sortBy = "due_asc") {
    let visible = tasks.filter(t => {
      const q = filterText.trim().toLowerCase();
      if (q) {
        const hay = (t.title + " " + (t.assignees || "") + " " + (t.desc || "")).toLowerCase();
        if (!hay.includes(q)) return false;
      }
      if (filterStatus && t.status !== filterStatus) return false;
      return true;
    });

    // sort
    visible.sort((a, b) => {
      if (sortBy.includes("due")) {
        const da = a.due ? new Date(a.due) : null;
        const db = b.due ? new Date(b.due) : null;
        if (!da && !db) return 0;
        if (!da) return 1;
        if (!db) return -1;
        return sortBy === "due_asc" ? da - db : db - da;
      } else if (sortBy === "priority") {
        const map = { urgent: 3, high: 2, medium: 1, low: 0 };
        return (map[b.priority?.toLowerCase()] ?? 0) - (map[a.priority?.toLowerCase()] ?? 0);
      }
      return 0;
    });

    root.innerHTML = "";
    if (visible.length === 0) {
      emptyEl.innerText = "No tasks found.";
      root.appendChild(emptyEl);
      return;
    }

    visible.forEach(task => {
      const card = document.createElement("div");
      card.className = "kt-card";
      card.dataset.id = task.id;
      card.tabIndex = 0;

      card.innerHTML = `
        <div class="kt-accent ${priorityClass(task.priority)}"></div>
        <div class="kt-card-body">
          <div class="kt-card-row">
            <h4 class="kt-card-title">${escapeHtml(task.title)}</h4>
            <div class="kt-badges">
              <span class="${statusBadgeClass(task.status)}">${escapeHtml(task.status)}</span>
              <span class="kt-due">${task.due ? new Date(task.due).toLocaleDateString(undefined,{month:"short",day:"numeric"}) : "—"}</span>
            </div>
          </div>
          <div class="kt-desc">${escapeHtml(task.desc)}</div>
          <div class="kt-meta">
            <div class="kt-avatars">
              ${(task.assignees || "")
                .split(",").map(s => s.trim()).filter(Boolean).slice(0, 3)
                .map(a => `<span class="kt-avatar" title="${escapeHtml(a)}">${escapeHtml(initials(a))}</span>`).join("")}
              ${(task.assignees || "").split(",").map(s => s.trim()).filter(Boolean).length > 3
                ? `<span class="kt-avatar more">+${(task.assignees || "").split(",").filter(Boolean).length - 3}</span>` : ""}
            </div>
            <div class="small muted">
              <div>Priority: <strong>${escapeHtml(task.priority)}</strong></div>
              <div style="margin-top:6px">Progress: <strong>${statusProgress(task.status)}%</strong></div>
            </div>
          </div>
        </div>
      `;

      card.addEventListener("click", () => openModal(task.id));
      card.addEventListener("keydown", e => { if (e.key === "Enter") openModal(task.id); });

      root.appendChild(card);
    });
  }

  // ---------- Stats ----------
  function updateStats() {
    $("#ktTotal").innerText = tasks.length;
    $("#ktCountToDo").innerText = tasks.filter(t => t.status === "To Do").length;
    $("#ktCountProg").innerText = tasks.filter(t => t.status === "In Progress").length;
    $("#ktCountRev").innerText = tasks.filter(t => t.status === "Review").length;
    $("#ktCountDone").innerText = tasks.filter(t => t.status === "Done").length;

    const done = tasks.filter(t => t.status === "Review").length;
    const ratio = tasks.length ? Math.round((done / tasks.length) * 100) : 0;
    $("#ktProgBar").style.width = ratio + "%";
  }

  // ---------- Modal ----------
  const modal = $("#ktModal");
  const backdrop = $("#ktBackdrop");
  const fieldStatus = $("#ktFieldStatus");
  const fieldComment = $("#ktFieldComment");
  let currentId = null;

  function openModal(id) {
    console.log(id)
    currentId = id;
    const task = tasks.find(t => t.id === id);
    if (!task) return;

    $("#ktModalTitle").innerText = task.title;
    $("#viewTitle").innerText = task.title;
    $("#viewAssignees").innerText = task.assignees || "—";
    $("#viewPriority").innerText = task.priority;
    $("#viewDue").innerText = task.due ? new Date(task.due).toLocaleDateString() : "—";
    $("#viewDesc").innerText = task.desc || "—";

    fieldStatus.value = task.status;
    fieldComment.value = "";

    modal.classList.add("show");
    modal.setAttribute("aria-hidden", "false");
  }

  function closeModal() {
    modal.classList.remove("show");
    modal.setAttribute("aria-hidden", "true");
    currentId = null;
  }

  $("#ktClose").addEventListener("click", closeModal);
  backdrop.addEventListener("click", closeModal);
  document.addEventListener("keydown", e => { if (e.key === "Escape") closeModal(); });

  // ---------- Save ----------
  $("#ktSave").addEventListener("click", () => {
    if (!currentId) return;
    const task = tasks.find(t => t.id === currentId);
    if (!task) return;

    const updated = {
      id: task.id,
      status: fieldStatus.value,
      comment: fieldComment.value.trim()
    };

    task.status = updated.status;
    renderList($("#ktSearch").value, $("#ktFilterStatus").value, $("#ktSort").value);
    updateStats();

   const formData = new FormData();
formData.append("status", fieldStatus.value);

fetch(`/admin/managetasks/${task.id}/update-status`, {
  method: "POST",
  headers: {
    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
  },
  body: formData
})
  .then(res => res.json())
  .then(data => {
    console.log("Updated:", data);
    closeModal();
  })
  .catch(err => {
    console.error("Error:", err);
    alert("Failed to update task");
  });

  });

  // ---------- Search / Filter / Sort ----------
  $("#ktSearch").addEventListener("input", e => {
    renderList(e.target.value, $("#ktFilterStatus").value, $("#ktSort").value);
  });
  $("#ktFilterStatus").addEventListener("change", e => {
    renderList($("#ktSearch").value, e.target.value, $("#ktSort").value);
  });
  $("#ktSort").addEventListener("change", e => {
    renderList($("#ktSearch").value, $("#ktFilterStatus").value, e.target.value);
  });

  // ---------- Init ----------
  updateStats();
  renderList();
</script>



@endsection
