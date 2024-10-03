<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\RiasecScore;
use App\Models\User;
use Illuminate\Http\Request;

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
    
}
