<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTasksController extends Controller
{
    // Admin tasks management
    public function manageTasks(Request $request,$id)
    {
        // Fetch all tasks
        // $tasks = Task::all();

        // Fetch only admin names
        $admins = Admin::where('name', '!=', 'God Admin')->pluck('name', 'id');

  // Create members array with fake values
  $members = collect($admins)->map(function($name, $id){
      // Generate fake task count (0–10)
      $count = rand(0, 10);

      // Generate fake percent (0–100)
      $percent = $count > 0 ? rand(20, 100) : 0;

      return (object)[
          'id'      => $id,
          'name'    => $name,
          'avatar'  => null, // fallback → initials in view
          'count'   => $count,
          'percent' => $percent,
      ];
  });

        return view("admin.tasks.tasks-$id", compact('admins', 'members'));
    }


    public function myTasks(Request $request) {
    $admin = Auth::user(); // current logged-in admin (assuming Laravel Auth)

    // Fake tasks for demo
    $tasks = [
        (object)['title' => 'Fix login bug', 'status' => 'To Do'],
        (object)['title' => 'Update dashboard UI', 'status' => 'In Progress'],
        (object)['title' => 'Write weekly report', 'status' => 'Review'],
        (object)['title' => 'Deploy to production', 'status' => 'Done'],
    ];

    return view('admin.tasks.my-tasks', [
        'adminName' => $admin->name ?? 'Unknown Admin',
        'tasks' => $tasks
    ]);
}

}
