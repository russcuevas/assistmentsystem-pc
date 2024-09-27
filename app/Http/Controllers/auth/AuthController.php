<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function AdminLoginPage()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard.page');
        }

        return view('auth.admin.login');
    }

    public function AdminLoginRequest(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard.page');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.page');
    }



    // USERS AUTH
    public function ExamineesLoginPage()
    {
        if (Auth::guard('users')->check()) {
            return redirect()->route('users.information.page');
        }

        return view('auth.users.login');
    }

    public function ExamineesLoginRequest(Request $request)
    {
        $credentials = $request->only('default_id', 'password');
        if (Auth::guard('users')->attempt($credentials)) {
            return redirect()->route('users.information.page');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function ExamineesLogout()
    {
        Auth::guard('users')->logout();
        return redirect()->route('users.login.page');
    }
}
