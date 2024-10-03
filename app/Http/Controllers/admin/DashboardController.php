<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\RiasecScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function AdminDashboardPage()
    {
        $get_total_admin = Admin::count();
        $get_total_examinees = User::whereNotNull('fullname')->where('fullname', '!=', '')->count();
        $get_total_course = Course::count();
        return view('admin.dashboard.admin_dashboard', compact('get_total_admin', 'get_total_examinees', 'get_total_course'));
    }

    public function GetYearlyExaminees()
    {
        try {
            $examinees = RiasecScore::selectRaw('YEAR(created_at) as year, COUNT(DISTINCT user_id) as examinee_count')
                ->groupBy('year')
                ->orderBy('year')
                ->get();

            return response()->json($examinees);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function AdminChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string|',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->old_password, $admin->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Old password is incorrect.']);
        }

        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
