<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\NewAdminWelcomeEmail;
use App\Mail\SendOtpForPasswordChange;
use Carbon\Carbon;
use App\Models\AdminLoginInfo;
use App\Models\Blog;
use App\Models\ContactForm;
use App\Models\Task;
use App\Models\UserChat;
use Jenssegers\Agent\Agent;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check() || session('super_admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        $admin = Admin::where('email', env('GOD_ADMIN_EMAIL'))->first();
        if ($admin && $admin->last_seen && Carbon::parse($admin->last_seen)->lt(now()->subHours(2))) {
            $admin->status = 'Inactive';
            $admin->login_count = 0; // Reset login count

            $admin->save();
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
        
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        $ip = $request->ip();
        $agent = new Agent();
        $agent->setUserAgent($request->header('User-Agent'));
        $browser = $agent->browser();
        $browserVersion = $agent->version($browser);
        $platform = $agent->platform();
        $platformVersion = $agent->version($platform);

        $userAgentShort = $browser . ' ' . $browserVersion . ' on ' . $platform . ' ' . $platformVersion;

      

        if (
            $credentials['email'] === env('GOD_ADMIN_EMAIL') &&
            !Hash::check($credentials['password'], env('GOD_ADMIN_PASSWORD_HASH'))
        ) {
            // Log unauthorized access attempt
            Log::warning('Unauthorized admin access attempt', [
                'email' => $credentials['email'],
                'ip' => $ip,
                'user_agent' => $userAgentShort
            ]);
            
            return back()->withErrors(['email' => 'Access denied. Invalid credentials.']);
        }

        // Check super admin from .env
        if (
            $credentials['email'] === env('GOD_ADMIN_EMAIL') &&
            Hash::check($credentials['password'], env('GOD_ADMIN_PASSWORD_HASH'))
        ) {

            $existing = Admin::where('email', env('GOD_ADMIN_EMAIL'))->first();

            if (!$existing) {
                Admin::create([
                    'name' => 'God Admin',
                    'email' => env('GOD_ADMIN_EMAIL'),
                    'password' => env('GOD_ADMIN_PASSWORD_HASH'), // already hashed
                    'role' => 'god_admin',
                    'status' =>  'active',
                    'last_seen' => now(),
                    'remember_token' => $remember ? Str::random(60) : null,
                ]);
            }

            $admin = Admin::where('email', env('GOD_ADMIN_EMAIL'))->first();
            
            Auth::guard('admin')->loginUsingId($admin->id, $remember);
            session(['god_admin_logged_in' => true]);
            AdminLoginInfo::create([
                'admin_id' => $admin->id,
                'name' => $admin->name,
                'ip_address' => $ip,
                'status' => 'Success',
                'user_agent' => $userAgentShort,
            ]);

            return redirect()->intended('/admin/dashboard');
        }

        // Normal admin login
        $admin = Admin::where('email', $credentials['email'])->first();
        if (!$admin) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
        $logData = [
            'admin_id' => $admin ? $admin->id : null,
            'name' => $admin ? $admin->name : $credentials['email'],
            'ip_address' => $ip,
            'user_agent' => $userAgentShort,
        ];
        if (!$admin) {
            AdminLoginInfo::create(array_merge($logData, ['status' => 'Failure']));
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        if ($admin->status === 'blocked') {
            // Check if the user has been blocked for more than 2 hours
            if ($admin->last_seen && Carbon::parse($admin->last_seen)->lt(now()->subHours(2))) {
                // Unblock the user after 2 hours
                $admin->status = 'Inactive';
                $admin->login_count = 0; // Reset login count
                $admin->save();
            } else {
                // User is still blocked and hasn't been blocked for 2 hours yet
                session()->forget('super_admin_logged_in');
                AdminLoginInfo::create(array_merge($logData, ['status' => 'Failure']));
                return back()->withErrors(['email' => 'Your account is blocked.']);
            }
        }





        if (!Hash::check($credentials['password'], $admin->password)) {
            // make the login_count increment
            if ($credentials['email'] != env('GOD_ADMIN_EMAIL')) {
                if ($admin->login_count >= 5) {
                    $admin->update(['status' => 'blocked']);
                    AdminLoginInfo::create(array_merge($logData, ['status' => 'Failure']));
                    return back()->withErrors(['email' => 'Your account is blocked due to multiple failed login attempts try again after 2 hours.']);
                } else {
                    $admin->increment('login_count');
                }
            }

            AdminLoginInfo::create(array_merge($logData, ['status' => 'Failure']));
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        Auth::guard('admin')->loginUsingId($admin->id, $remember);
        if ($admin) {
            Admin::where('id', $admin->id)->update(['last_seen' => now()]);
        }
        if ($admin->status === 'blocked') {
            AdminLoginInfo::create(array_merge($logData, ['status' => 'Failure']));
            return back()->withErrors(['email' => 'Your account is blocked.']);
        }
        if ($admin->status === 'unactivated') {
            AdminLoginInfo::create(array_merge($logData, ['status' => 'Success']));
            return redirect()->intended(
                '/admin/change-password'
            );
        }
        AdminLoginInfo::create(array_merge($logData, ['status' => 'Success']));
        return redirect()->intended('/admin/dashboard');
    }

    public function dashboard()
    {
        // First check if user is authenticated
        if (!Auth::guard('admin')->check() && !session('super_admin_logged_in') && !session('god_admin_logged_in')) {
            return redirect()->route('login');
        }

        // Now safely get the authenticated user
        $user = Auth::guard('admin')->user();

        // If no user found (shouldn't happen but safety check)
        if (!$user) {
            return redirect()->route('login');
        }

        // Check user status
        if ($user->status == 'blocked') {
            return redirect()->route('admin.unauthorized')->with('error', 'Your account is blocked. Please contact with Super Admin or The GOD ADMIN.');
        }

        if ($user->role == 'editor') {
            return redirect()->route('admin.blog.list');
        }

        if ($user->status == 'unactivated') {
            return redirect()->intended('/admin/change-password');
        }
        $usersCount = UserChat::count();
        $unreadMessages = ContactForm::where('status', 'new')->count();
        $newTasks = Task::where('status', 'To Do')->count();
        // $newTasks = Task::whereNotIn('status', ['In Progress','Review', 'Done'])->count();
        $pendingPosts = Blog::whereNotIn('status', ['Published'])->count();

        return view('admin.home', compact('usersCount', 'newTasks', 'unreadMessages', 'pendingPosts'));
    }

    public function logout()
    {
        $user = auth()->guard('admin')->user();
        if ($user) {
            Admin::where('id', $user->id)->update(['status' => 'Inactive']);
        }
        Auth::guard('admin')->logout();
        session()->forget('super_admin_logged_in');
        return redirect()->route('login');
    }

    public function manageAdmins()
    {
        $user = auth()->guard('admin')->user();

        if ($user->role !== 'super_admin' && $user->email !== env('GOD_ADMIN_EMAIL')) {
            return redirect()->route('admin.unauthorized')->with('error', 'You don\'t have permission to access this page.');
        }
        if ($user->status == 'blocked') {
            return redirect()->route('admin.unauthorized')->with('error', 'Your account is blocked. Please contact with Super Admin or The GOD ADMIN.');
        }

        $admins = Admin::all()->map(function ($admin) {
            $lastSeen = $admin->last_seen;
            $isActive = $lastSeen && $lastSeen->diffInMinutes(now()) < 2; // Consider active if seen in last 5 minutes
            if ($admin->status == 'blocked') {
                $status = 'blocked';
            } elseif ($admin->status == 'unactivated') {
                $status = 'unactivated';
            } else {
                $status = $isActive ? 'active' : 'inactive';
            }

            return [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => $admin->role,
                'status' => $status,
                'last_login' => $lastSeen ? $lastSeen->diffForHumans() : 'Never',
                'avatar' => Str::upper(substr($admin->name, 0, 2))
            ];
        });

        return view('admin.manage-admins', ['admins' => $admins]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();

        // Allow only super admin
        if ($user->role !== 'super_admin' && $user->email !== env('GOD_ADMIN_EMAIL')) {
            return redirect()->route('admin.unauthorized')->with('error', 'You don\'t have permission to access this page.');
        }

        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
        }

        DB::beginTransaction();

        try {
            // Create the admin
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
                'status' => 'unactivated',
                'last_seen' => now(),
                'remember_token' => Str::random(60),
            ]);

            $emailData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password, // Pass the plain-text password
                'role' => $request->role,
            ];

            // Send welcome email using the Mailable class
            Mail::to($request->email)->send(new NewAdminWelcomeEmail($emailData));

            // If email is sent successfully, commit the transaction
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Admin created successfully']);
        } catch (\Exception $e) {
            // If any exception occurs, roll back the transaction
            DB::rollBack();

            // Log the detailed error for debugging
            Log::error('Failed to create admin or send email: ' . $e->getMessage());

            // Return a specific error message to the user for debugging
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();

        if ($user->role !== 'super_admin' && $user->email !== env('GOD_ADMIN_EMAIL')) {
            return redirect()->route('admin.unauthorized')->with('error', 'You don\'t have permission to access this page.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'role' => 'required',
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
        }

        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role = $request->role;

        $admin->password = $request->password;

        $admin->save();

        return response()->json(['success' => true, 'message' => 'Admin updated successfully']);
    }


    public function destroy($id)
    {
        $user = auth()->guard('admin')->user();

        if ($user->role !== 'super_admin' && $user->email !== env('GOD_ADMIN_EMAIL')) {
            return redirect()->route('admin.unauthorized')->with('error', 'You don\'t have permission to access this page.');
        }

        // Prevent deleting self
        if ($user->id == $id) {
            return response()->json(['success' => false, 'message' => 'You cannot delete your own account'], 422);
        }

        $admin = Admin::findOrFail($id);
        $admin->delete();

        return response()->json(['success' => true, 'message' => 'Admin deleted successfully']);
    }



    public function unblockAdmin(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();

        if ($user->role !== 'super_admin' && $user->email !== env('GOD_ADMIN_EMAIL')) {
            $msg = 'You don\'t have permission to access this page.';
            if ($request->ajax() || $request->isMethod('put')) {
                return response()->json(['success' => false, 'message' => $msg], 403);
            }
            return redirect()->route('admin.unauthorized')->with('error', $msg);
        }

        $admin = Admin::findOrFail($id);
        if ($admin->role == 'super_admin' && $user->role !== 'god_admin') {
            $msg = 'You cannot unblock a Super Admin unless you are the God Admin.';
            if ($request->ajax() || $request->isMethod('put')) {
                return response()->json(['success' => false, 'message' => $msg], 403);
            }
            return redirect()->back()->with('error', $msg);
        }
        $admin->status = 'Inactive';
        $admin->login_count = 0; // Reset login count
        $admin->save();

        $msg = 'Admin unblocked successfully';
        if ($request->ajax() || $request->isMethod('put')) {
            return response()->json(['success' => true, 'message' => $msg]);
        }
        return redirect()->back()->with('success', $msg);
    }

    public function heartbeat()
    {
        $user = auth()->guard('admin')->user();
        if ($user) {
            Admin::where('id', $user->id)->update(['last_seen' => now()]);
        }
        return response()->json(['status' => 'ok']);
    }
    public function unauthorized()
    {
        return view('admin.unauthorized');
    }

    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    public function sendOtp(Request $request)
    {
        /** @var \App\Models\Admin $user */
        $user = Auth::guard('admin')->user();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found.']);
        }

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        // Generate OTP
        $otp = random_int(100000, 999999);

        // Store OTP and new password in session
        $request->session()->put('password_change_otp', $otp);
        $request->session()->put('password_change_new_password', $request->new_password);
        $request->session()->put('password_change_otp_expires_at', Carbon::now()->addMinutes(10));

        // Send OTP email
        try {
            Mail::to($user->email)->send(new SendOtpForPasswordChange($otp));
        } catch (\Exception $e) {
            Log::error('OTP Send Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to send OTP email. Please check your mail configuration.']);
        }

        return redirect()->route('admin.password.verify.form')->with('success', 'An OTP has been sent to your email.');
    }

    public function showVerifyOtpForm()
    {
        return view('admin.verify-otp');
    }

    public function verifyOtpAndUpdatePassword(Request $request)
    {
        /** @var \App\Models\Admin $user */
        $user = Auth::guard('admin')->user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Session expired. Please log in again.']);
        }

        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Retrieve data from session
        $sessionOtp = $request->session()->get('password_change_otp');
        $sessionNewPassword = $request->session()->get('password_change_new_password');
        $sessionExpiry = $request->session()->get('password_change_otp_expires_at');

        if (!$sessionOtp || !$sessionNewPassword || !$sessionExpiry) {
            return redirect()->route('admin.password.change')->withErrors(['error' => 'Your session has expired. Please try again.']);
        }

        if (Carbon::now()->gt($sessionExpiry)) {
            return redirect()->route('admin.password.change')->withErrors(['error' => 'The OTP has expired. Please try again.']);
        }

        if ($request->otp != $sessionOtp) {
            return redirect()->back()->withErrors(['otp' => 'The OTP you entered is incorrect.']);
        }

        // Update password
        $user->password = $sessionNewPassword;
        $user->status = 'active';
        $user->save();

        // Forget session data
        $request->session()->forget([
            'password_change_otp',
            'password_change_new_password',
            'password_change_otp_expires_at'
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully!');
    }

    public function signInLogs()
    {
        $logs = \App\Models\AdminLoginInfo::with('admin')->orderBy('created_at', 'desc')->get();
        return view('admin.sign-in-logs', compact('logs'));
    }

    public function showSendEmailForm()
    {
        return view('admin.send-email');
    }

// public function sendEmail(Request $request)
// {
//     $request->validate([
//         'from' => 'required|email',
//         'to' => 'required|email',
//         'subject' => 'required|string|max:255',
//         'content' => 'required|string',
//     ]);

//     \Mail::raw($request->content, function ($message) use ($request) {
//         $message->from($request->from)
//                 ->to($request->to)
//                 ->subject($request->subject);
//     });

//     return back()->with('success', 'Email sent successfully!');
// }
}