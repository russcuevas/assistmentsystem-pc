<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\RiasecScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function AdminDashboardPage()
    {
        $course = Course::all();
        $get_total_admin = Admin::count();
        $get_total_examinees = User::whereNotNull('fullname')->where('fullname', '!=', '')->count();
        $get_total_course = Course::count();

        $userScores = DB::table('riasec_scores')
            ->select('user_id', 'riasec_id', DB::raw('SUM(points) as total_points'), 'created_at')
            ->groupBy('user_id', 'riasec_id', 'created_at')
            ->orderByDesc('total_points')
            ->get();

        $groupedUserScores = [];
        $scoreDates = [];
        foreach ($userScores as $score) {
            $groupedUserScores[$score->user_id][$score->riasec_id] = $score->total_points;
            $scoreDates[$score->user_id][$score->riasec_id] = $score->created_at;
        }

        $topScores = [];
        foreach ($groupedUserScores as $userId => $scores) {
            arsort($scores);
            $topScores[$userId] = array_slice($scores, 0, 3, true);
        }

        $users = DB::table('users')->whereIn('id', array_keys($topScores))->pluck('fullname', 'id');
        $preferredCourses = [];
        $suggestedCourses = [];

        foreach ($topScores as $userId => $scores) {
            foreach ($scores as $riasec_id => $total_points) {
                $courses = DB::table('course_career_pathways')
                    ->join('career_pathways', 'course_career_pathways.career_pathway_id', '=', 'career_pathways.id')
                    ->join('courses', 'course_career_pathways.course_id', '=', 'courses.id')
                    ->where('career_pathways.riasec_id', $riasec_id)
                    ->select('courses.course_name', 'career_pathways.career_name')
                    ->get();

                $suggestedCourses[$userId][$riasec_id] = $courses;

                $userPreferredCourses = DB::table('preferred_courses')->where('user_id', $userId)->first();
                $preferredCourses[$userId][$riasec_id] = $userPreferredCourses ? [
                    'course_1' => $this->getCourseName($userPreferredCourses->course_1),
                    'course_2' => $this->getCourseName($userPreferredCourses->course_2),
                    'course_3' => $this->getCourseName($userPreferredCourses->course_3),
                ] : [
                    'course_1' => 'N/A',
                    'course_2' => 'N/A',
                    'course_3' => 'N/A',
                ];
            }
        }

        return view('admin.dashboard.admin_dashboard', compact('course', 'get_total_admin', 'get_total_examinees', 'get_total_course', 'topScores', 'users', 'suggestedCourses', 'preferredCourses', 'scoreDates'));
    }

    private function getCourseName($courseId)
    {
        return DB::table('courses')->where('id', $courseId)->value('course_name') ?? 'N/A';
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
            'old_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->old_password, $admin->password)) {
            return response()->json(['errors' => ['old_password' => ['Old password is incorrect.']]], 400);
        }

        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        return response()->json(['success' => 'Password changed successfully.']);
    }
}
