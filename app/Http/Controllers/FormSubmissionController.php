<?php

namespace App\Http\Controllers;

use App\Models\Booknowform;
use App\Models\BookOurService;
use App\Models\BookThisTour;
use App\Models\ContactForm;
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
    }
}