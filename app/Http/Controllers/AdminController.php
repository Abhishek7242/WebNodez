<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check() || session('super_admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if (
            $credentials['email'] === env('SUPER_ADMIN_EMAIL') &&
            !Hash::check($credentials['password'], env('SUPER_ADMIN_PASSWORD_HASH'))
        ) {
            return back()->withErrors(['email' => 'Not found']);
        }

        // Check super admin from .env
        if (
            $credentials['email'] === env('SUPER_ADMIN_EMAIL') &&
            Hash::check($credentials['password'], env('SUPER_ADMIN_PASSWORD_HASH'))
        ) {

            $existing = Admin::where('email', env('SUPER_ADMIN_EMAIL'))->first();

            if (!$existing) {
                Admin::create([
                    'name' => 'Super Admin',
                    'email' => env('SUPER_ADMIN_EMAIL'),
                    'password' => env('SUPER_ADMIN_PASSWORD_HASH'), // already hashed
                    'role' => 'super_admin',
                    'status' =>  'active',
                    'last_seen' => now(),
                    'remember_token' => $remember ? Str::random(60) : null,
                ]);
            }

            $admin = Admin::where('email', env('SUPER_ADMIN_EMAIL'))->first();
            Auth::guard('admin')->loginUsingId($admin->id, $remember);
            session(['super_admin_logged_in' => true]);

            return redirect()->intended('/admin/dashboard');
        }

        // Normal admin login
        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Not found']);
        }

        if (!Hash::check($credentials['password'], $admin->password)) {
            return back()->withErrors(['email' => 'Password not matched']);
        }

        Auth::guard('admin')->loginUsingId($admin->id, $remember);
        if ($admin) {
            Admin::where('id', $admin->id)->update(['last_seen' => now()]);
        }
        return redirect()->intended('/admin/dashboard');
    }

    public function dashboard()
    {
        if (!Auth::guard('admin')->check() && !session('super_admin_logged_in')) {
            return redirect()->route('login');
        }
        if (Auth::guard('admin')->user()->role == 'editor') {
            return redirect()->route('admin.blog.list');
        }

        return view('admin.home');
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

        if ($user->role !== 'super_admin' && $user->email !== env('SUPER_ADMIN_EMAIL')) {
            abort(403, 'Unauthorized');
        }

        $admins = Admin::all()->map(function ($admin) {
            $lastSeen = $admin->last_seen;
            $isActive = $lastSeen && $lastSeen->diffInMinutes(now()) < 2; // Consider active if seen in last 5 minutes

            return [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => $admin->role,
                'status' => $isActive ? 'active' : 'inactive',
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
        if ($user->role !== 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
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

        // Create the admin
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'status' => 'Inactive',
            'last_seen' => now(),
            'remember_token' => Str::random(60),
        ]);

        return response()->json(['success' => true, 'message' => 'Admin created successfully']);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();

        if ($user->role !== 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
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

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return response()->json(['success' => true, 'message' => 'Admin updated successfully']);
    }


    public function destroy($id)
    {
        $user = auth()->guard('admin')->user();

        if ($user->role !== 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Prevent deleting self
        if ($user->id == $id) {
            return response()->json(['success' => false, 'message' => 'You cannot delete your own account'], 422);
        }

        $admin = Admin::findOrFail($id);
        $admin->delete();

        return response()->json(['success' => true, 'message' => 'Admin deleted successfully']);
    }

    public function heartbeat()
    {
        $user = auth()->guard('admin')->user();
        if ($user) {
            Admin::where('id', $user->id)->update(['last_seen' => now()]);
        }
        return response()->json(['status' => 'ok']);
    }
}