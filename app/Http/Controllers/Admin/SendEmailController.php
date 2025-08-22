<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SendEmailController extends Controller
{
    public function showForm()
    {
        return view('admin.send-email');
    }

    public function send(Request $request)
    {
        $request->validate([
            'from' => 'required|email',
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $from = $request->input('from');
        $to = $request->input('to');
        $subject = $request->input('subject');
        $content = $request->input('content');

        // Dynamically set SMTP credentials based on sender
        if ($from === env('MAIL_FROM_SUPPORT')) {
            config([
                'mail.mailers.smtp.username' => env('MAIL_SUPPORT_USERNAME'),
                'mail.mailers.smtp.password' => env('MAIL_PASSWORD', env('MAIL_PASSWORD')),
                'mail.from.address' => env('MAIL_FROM_SUPPORT'),
                'mail.from.name' => env('MAIL_FROM_NAME', 'Linkuss'),
            ]);
        } else {
            config([
                'mail.mailers.smtp.username' => env('MAIL_USERNAME'),
                'mail.mailers.smtp.password' => env('MAIL_PASSWORD'),
                'mail.from.address' => env('MAIL_FROM_ADDRESS'),
                'mail.from.name' => env('MAIL_FROM_NAME', 'Linkuss'),
            ]);
        }

        try {
            $mailable = new \App\Mail\AdminCustomMail($subject, $content, $from);
            Mail::to($to)->send($mailable);
            return back()->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}
