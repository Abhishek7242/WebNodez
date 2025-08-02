<?php

namespace App\Http\Controllers;

use App\Models\Booknowform;
use App\Models\BookOurService;
use App\Models\BookThisTour;
use App\Models\ContactForm;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Ensure correct import
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormEmail;

class FormSubmissionController extends Controller
{

    public function contactDetails()
    {
        $user = auth()->guard('admin')->user();

        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        $details = ContactForm::all()->map(function ($details) {

            return [
                'id' => $details->id,
                'name' => $details->name,
                'email' => $details->email,
                'phone' => $details->number,
                'message' => $details->message,
                'status' => $details->status ? $details->status : 'New',
                'created_at' => $details->created_at,


            ];
        });
        $formantedDetails = $details->reverse();
        // return view('admin.manage-admins', ['admins' => $admins]);

        return view('admin.contact-form-details', ['contacts' => $formantedDetails]);
    }

    public function contactUs(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:225',
            'email' => 'required|email|max:225',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->toArray(),
            ], 422);
        }

        // If validation passes, save the data
        $contact = new ContactForm();

        $contact->name = $request->name;
        $contact->email = $request->email;
        // $contact->number = '+' . $request->countryCode . $request->number;
        $contact->number = $request->number;
        $contact->message = $request->message ? $request->message : '';
        $contact->status = 'New';
        $contact->save();

        // Prepare email data
        $emailData = [
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->number,
            'message' => $contact->message,
            'created_at' => $contact->created_at->format('F j, Y \a\t g:i A'),
        ];

        // Send email to all super_admin and god_admin users
        try {
            // Get all super_admin and god_admin users
            $adminUsers = \App\Models\Admin::whereIn('role', ['super_admin', 'god_admin'])
                ->where('status', '!=', 'blocked')
                ->get();

            $adminEmails = $adminUsers->pluck('email')->toArray();

            // If no admin users found, use default email
            if (empty($adminEmails)) {
                $adminEmails = [env('ADMIN_EMAIL', 'mark217242@gmail.com')];
            }

            // Send email to all admin users
            Mail::to($adminEmails)->send(new ContactFormEmail($emailData));
        } catch (\Exception $e) {
            // Log the error but don't fail the form submission
            Log::error('Failed to send contact form email: ' . $e->getMessage());
        }

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Contact form submitted successfully',
            'data' => $request->all(),
        ], 201);
    }

    public function getContactDetails($id)
    {
        $user = auth()->guard('admin')->user();

        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }



        $contact = ContactForm::findOrFail($id);
        $contact->status = 'read';
        $contact->save();

        return response()->json([
            'id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->number,
            'message' => $contact->message,
            'status' => $contact->status,
            'created_at' => $contact->created_at
        ]);
    }
    public function markReplied($id)
    {
        $user = auth()->guard('admin')->user();

        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }



        $contact = ContactForm::findOrFail($id);
        $contact->status = 'Replied';
        $contact->save();

        return response()->json([
            'success' => true,

        ]);
    }

    public function deleteMessage($id)
    {
        $user = auth()->guard('admin')->user();

        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }


        $contact = ContactForm::findOrFail($id);
        $contact->delete();
        return response()->json([
            'success' => true,
            'message' => 'Message deleted successfully'
        ]);
        // return redirect()->back()->with('success', 'Message deleted successfully.');
    }

    public function submitFeedback(Request $request)
    {
        // Validate the feedback submission
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid feedback data',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Store feedback in database
            $feedback = Feedback::create([
                'rating' => $request->rating,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'page_url' => $request->header('referer'),
            ]);

            // Optional: Send email notification to admin
            try {
                $adminEmails = \App\Models\Admin::whereIn('role', ['super_admin', 'god_admin', 'admin'])
                    ->where('status', '!=', 'blocked')
                    ->pluck('email')
                    ->toArray();

                if (!empty($adminEmails)) {
                    $ratingText = [
                        1 => 'Poor',
                        2 => 'Fair',
                        3 => 'Good',
                        4 => 'Very Good',
                        5 => 'Excellent'
                    ];

                    $emailData = [
                        'rating' => $ratingText[$request->rating],
                        'message' => $request->message ?: 'No additional message provided',
                        'submitted_at' => now()->format('F j, Y \a\t g:i A'),
                    ];

                    // Send feedback email to all admin users
                    Mail::to($adminEmails)->send(new \App\Mail\FeedbackEmail($emailData));
                }
            } catch (\Exception $e) {
                Log::error('Failed to send feedback email: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your feedback!'
            ]);
        } catch (\Exception $e) {
            Log::error('Feedback submission error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit feedback. Please try again.'
            ], 500);
        }
    }

    public function manageFeedback()
    {
        $user = auth()->guard('admin')->user();

        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }

        $feedback = Feedback::latest()->paginate(20);

        // Get feedback statistics
        $stats = [
            'total' => Feedback::count(),
            'average_rating' => Feedback::avg('rating'),
            'recent_feedback' => Feedback::recent(7)->count(),
            'rating_distribution' => [
                5 => Feedback::byRating(5)->count(),
                4 => Feedback::byRating(4)->count(),
                3 => Feedback::byRating(3)->count(),
                2 => Feedback::byRating(2)->count(),
                1 => Feedback::byRating(1)->count(),
            ]
        ];

        return view('admin.manage-feedback', compact('feedback', 'stats'));
    }
}
