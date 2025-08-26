<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminTasksController extends Controller
{
    // Admin tasks management
    public function manageTasks(Request $request)
    {
        // Fetch all tasks
        // $tasks = Task::all();

        // Fetch only admin names
        $admins = Admin::where('name', '!=', 'God Admin')->pluck('name', 'id');

        return view('admin.tasks.tasks-dashboard', compact('admins'));
    }
}
