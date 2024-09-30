<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function AnalyticsPage()
    {
        $riasec_scores = DB::table('riasec_scores')
            ->select('riasec_scores.riasec_id', DB::raw('SUM(riasec_scores.points) as total_points'))
            ->groupBy('riasec_scores.riasec_id')
            ->orderByDesc('total_points')
            ->limit(3)
            ->get();

        $users = DB::table('riasec_scores')
            ->join('users', 'riasec_scores.user_id', '=', 'users.id')
            ->join('career_pathways', 'riasec_scores.riasec_id', '=', 'career_pathways.riasec_id')
            ->leftJoin('preferred_courses', 'users.id', '=', 'preferred_courses.user_id')
            ->leftJoin('course_career_pathways', 'career_pathways.id', '=', 'course_career_pathways.career_pathway_id')
            ->leftJoin('courses', 'course_career_pathways.course_id', '=', 'courses.id')
            ->select(
                'users.fullname',
                'riasec_scores.riasec_id',
                'career_pathways.career_name',
                DB::raw('MAX(riasec_scores.points) as total_points'),
                'preferred_courses.course_1',
                'preferred_courses.course_2',
                'preferred_courses.course_3',
                DB::raw('GROUP_CONCAT(courses.course_name SEPARATOR ", ") as related_courses')
            )
            ->whereIn('riasec_scores.riasec_id', $riasec_scores->pluck('riasec_id'))
            ->groupBy('users.fullname', 'riasec_scores.riasec_id', 'career_pathways.career_name', 'preferred_courses.course_1', 'preferred_courses.course_2', 'preferred_courses.course_3')
            ->get();

        $grouped_users = $users->groupBy('fullname');
        return view('admin.analytics.analytics', compact('grouped_users', 'riasec_scores'));
    }
}
