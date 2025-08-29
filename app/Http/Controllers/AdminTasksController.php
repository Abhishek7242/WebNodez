<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTasksController extends Controller
{
    // Admin tasks management
    public function manageTasks(Request $request, $id)
    {
        // Fetch only admin names (exclude "God Admin")
        $admins = Admin::where('name', '!=', 'God Admin')->pluck('name', 'id');

        $members = $admins->map(function ($name, $id) {
            // Fetch total tasks assigned to this admin
            $total = Task::whereHas('assignees', function ($q) use ($id) {
                $q->where('admin_id', $id);
            })->count();

            // Fetch completed (Done) tasks for this admin
            $done = Task::whereHas('assignees', function ($q) use ($id) {
                $q->where('admin_id', $id);
            })->where('status', 'Done')->count();

            // Calculate completion %
            $percent = $total > 0 ? round(($done / $total) * 100) : 0;

            return (object)[
                'id'      => $id,
                'name'    => $name,
                'avatar'  => null, // fallback → initials in view
                'count'   => $total,
                'percent' => $percent,
            ];
        });


        // Fetch real tasks from DB with assignees
        $tasks = Task::with('assignees')->get()->map(function ($task) {
            return [
                'title'       => $task->title,
                'assignees'   => $task->assignees->pluck('name')->implode(', '),
                'status'      => $task->status,
                'priority'    => $task->priority,
                'due'         => $task->due_date ? Carbon::parse($task->due_date)->format('Y-m-d') : null,
                'description' => $task->description,
            ];
        })->toArray();
        // ✅ Task statistics
        $totalTasks   = Task::count();
        $doneTasks    = Task::where('status', 'Done')->count();
        $inProgress   = Task::where('status', 'In Progress')->count();
        $toDoTasks    = Task::where('status', 'To Do')->count(); // ✅ fixed casing
        $overdueTasks = Task::where('due_date', '<', now())
            ->where('status', '!=', 'Done')
            ->count();

        $stats = [
            ['title' => 'Total Tasks', 'value' => $totalTasks, 'sub' => ''],
            ['title' => 'Done', 'value' => $doneTasks, 'sub' => ''],
            ['title' => 'In Progress', 'value' => $inProgress, 'sub' => ''],
            ['title' => 'To Do', 'value' => $toDoTasks, 'sub' => ''], // ✅ added
            ['title' => 'Overdue', 'value' => $overdueTasks, 'sub' => ''],
        ];



        return view("admin.tasks.tasks-$id", compact('admins', 'members', 'tasks', 'stats'));
    }


    public function myTasks(Request $request)
    {
        $admin = Auth::user(); // current logged-in admin

        // Fetch tasks where this admin is assigned
        $tasks = Task::whereHas('assignees', function ($query) use ($admin) {
            $query->where('admins.id', $admin->id);
        })->get()->map(function ($task) {
            return (object)[
                'id' => $task->id, // <-- add this!
                'title' => $task->title,
                'status' => $task->status,
                'priority' => $task->priority,
                'due' => $task->due_date ? $task->due_date->format('Y-m-d') : null,
                'assignees' => $task->assignees->pluck('name')->implode(', '),
                'description' => $task->description,
            ];
        });

        return view('admin.tasks.my-tasks', [
            'adminName' => $admin->name ?? 'Unknown Admin',
            'tasks' => $tasks
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        if ($user->role !== 'super_admin' && $user->email !== env('GOD_ADMIN_EMAIL')) {
            return redirect()->route('admin.unauthorized')->with('error', 'You don\'t have permission to access this page.');
        }
        if ($user->status == 'blocked') {
            return redirect()->route('admin.unauthorized')->with('error', 'Your account is blocked. Please contact with Super Admin or The GOD ADMIN.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Backlog,To Do,In Progress,Review,Done',
            'priority' => 'required|in:Low,Medium,High,Urgent',
            'due' => 'nullable|date',
            'assignee_ids' => 'nullable|string',
        ]);

        $task = Task::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'],
            'priority' => $data['priority'],
            'due_date' => $data['due'] ?? null,
            'created_by' => auth()->id(), // or any admin id
        ]);

        if (!empty($data['assignee_ids'])) {
            $ids = explode(',', $data['assignee_ids']);
            $task->assignees()->attach($ids);
        }

        return response()->json(['success' => true, 'task' => $task]);
    }
    public function updateStatus(Request $request, $task)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:To Do,In Progress,Review,Done'
        ]);

        $task = Task::findOrFail($task);
        $task->status = $validated['status'];
        $task->save();

        return response()->json([
            'success' => true,
            'task'    => $task,
        ]);
    }
}
