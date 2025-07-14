<?php

namespace App\Http\Controllers;

use App\Models\ClientProject;
use App\Mail\ClientProjectStarted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminManageClientProgressController extends Controller
{
    public function index()
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        $projects = ClientProject::orderBy('created_at', 'desc')->get();
        return view('admin.manage-client-progress', compact('projects'));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        try {
            $request->validate([
                'project_name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|url|max:255',
                'status' => 'required|string|in:in_progress,completed,on_hold',
                'progress_percentage' => 'required|integer|min:0|max:100',
                'start_date' => 'nullable|date',
                'expected_completion_date' => 'nullable|date|after:start_date',
                'design_completed' => 'boolean',
                'development_completed' => 'boolean',
                'testing_completed' => 'boolean',
                'deployment_completed' => 'boolean',
            ]);

            $project = new ClientProject();
            $project->project_name = $request->project_name;
            $project->description = $request->description;
            $project->image = $request->image;
            $project->status = $request->status;
            $project->progress_percentage = $request->progress_percentage;
            $project->start_date = $request->start_date;
            $project->expected_completion_date = $request->expected_completion_date;
            $project->design_completed = $request->design_completed ?? false;
            $project->development_completed = $request->development_completed ?? false;
            $project->testing_completed = $request->testing_completed ?? false;
            $project->deployment_completed = $request->deployment_completed ?? false;
            $project->client_email = $request->client_email;
            $project->save();

            // Send email notification to client
            try {
                Mail::to($project->client_email)->send(new ClientProjectStarted($project));
            } catch (\Exception $e) {
                // Log the email error but don't fail the project creation
                Log::error('Failed to send project start email: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Project added successfully and notification sent to client',
                'project' => $project
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding project: ' . $e->getMessage()
            ], 422);
        }
    }

    public function update(Request $request, $uuid)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        try {
            $request->validate([
                'project_name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|url|max:255',
                'status' => 'required|string|in:in_progress,completed,on_hold',
                'progress_percentage' => 'required|integer|min:0|max:100',
                'start_date' => 'nullable|date',
                'expected_completion_date' => 'nullable|date',
                'design_completed' => 'boolean',
                'development_completed' => 'boolean',
                'testing_completed' => 'boolean',
                'deployment_completed' => 'boolean',
                'client_email' => 'nullable|email',
            ]);

            // Custom validation for completion date after start date
            if ($request->start_date && $request->expected_completion_date) {
                if (strtotime($request->expected_completion_date) <= strtotime($request->start_date)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Expected completion date must be after start date'
                    ], 422);
                }
            }

            $project = ClientProject::where('uuid', $uuid)->firstOrFail();
            $project->project_name = $request->project_name;
            $project->description = $request->description;
            $project->image = $request->image;
            $project->status = $request->status;
            $project->progress_percentage = $request->progress_percentage;
            $project->start_date = $request->start_date;
            $project->expected_completion_date = $request->expected_completion_date;
            $project->design_completed = $request->design_completed ?? false;
            $project->development_completed = $request->development_completed ?? false;
            $project->testing_completed = $request->testing_completed ?? false;
            $project->deployment_completed = $request->deployment_completed ?? false;

            // Update client email if provided
            if ($request->has('client_email')) {
                $project->client_email = $request->client_email;
            }

            $project->save();

            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully',
                'project' => $project
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating project: ' . $e->getMessage()
            ], 422);
        }
    }

    public function destroy($uuid)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        try {
            $project = ClientProject::where('uuid', $uuid)->firstOrFail();
            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting project: ' . $e->getMessage()
            ], 422);
        }
    }

    public function show($uuid)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        $project = ClientProject::where('uuid', $uuid)->firstOrFail();
        return response()->json([
            'success' => true,
            'project' => $project
        ]);
    }

    public function viewProgress($uuid)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        $project = ClientProject::where('uuid', $uuid)->firstOrFail();
        return view('admin.view-project-progress', compact('project'));
    }

    public function completePhase(Request $request, $uuid)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        try {
            $request->validate([
                'phase' => 'required|string|in:design,development,testing,deployment',
                'completed' => 'required|boolean'
            ]);

            $project = ClientProject::where('uuid', $uuid)->firstOrFail();
            $phase = $request->phase;
            $completed = $request->completed;

            switch ($phase) {
                case 'design':
                    $project->design_completed = $completed;
                    break;
                case 'development':
                    $project->development_completed = $completed;
                    break;
                case 'testing':
                    $project->testing_completed = $completed;
                    break;
                case 'deployment':
                    $project->deployment_completed = $completed;
                    break;
            }

            // Update overall progress based on completed phases
            $project->progress_percentage = $project->getPhaseProgress();

            // Update status if all phases are completed
            if ($project->getPhaseProgress() == 100) {
                $project->status = 'completed';
            }

            $project->save();

            return response()->json([
                'success' => true,
                'message' => ucfirst($phase) . ' phase ' . ($completed ? 'completed' : 'marked as pending'),
                'project' => $project
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating phase: ' . $e->getMessage()
            ], 422);
        }
    }

    public function sendProjectEmail($uuid)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        try {
            $project = ClientProject::where('uuid', $uuid)->firstOrFail();

            if (empty($project->client_email)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No client email found for this project'
                ], 422);
            }

            // Send email notification to client
            Mail::to($project->client_email)->send(new ClientProjectStarted($project));

            return response()->json([
                'success' => true,
                'message' => 'Project notification email sent successfully to ' . $project->client_email
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send project email: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error sending email: ' . $e->getMessage()
            ], 422);
        }
    }
}
