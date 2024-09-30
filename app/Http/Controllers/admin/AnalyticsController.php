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
            ->select('riasec_id', DB::raw('SUM(points) as total_points'))
            ->groupBy('riasec_id')
            ->orderByDesc('total_points')
            ->limit(3)
            ->pluck('riasec_id');

        $users = DB::table('riasec_scores')
            ->join('users', 'riasec_scores.user_id', '=', 'users.id')
            ->join('career_pathways', 'riasec_scores.riasec_id', '=', 'career_pathways.riasec_id')
            ->join('riasecs', 'riasec_scores.riasec_id', '=', 'riasecs.id') // Join the riasecs table
            ->leftJoin('preferred_courses', 'users.id', '=', 'preferred_courses.user_id')
            ->leftJoin('courses as c1', 'preferred_courses.course_1', '=', 'c1.id')
            ->leftJoin('courses as c2', 'preferred_courses.course_2', '=', 'c2.id')
            ->leftJoin('courses as c3', 'preferred_courses.course_3', '=', 'c3.id')
            ->select(
                'users.fullname',
                'riasec_scores.riasec_id',
                'career_pathways.career_name',
                'riasecs.riasec_name',
                DB::raw('MAX(riasec_scores.points) as total_points'),
                'c1.course_name as course_1_name',
                'c2.course_name as course_2_name',
                'c3.course_name as course_3_name'
            )
            ->whereIn('riasec_scores.riasec_id', $riasec_scores)
            ->groupBy('users.fullname', 'riasec_scores.riasec_id', 'career_pathways.career_name', 'riasecs.riasec_name', 'c1.course_name', 'c2.course_name', 'c3.course_name')
            ->get();

        $relatedCourses = DB::table('course_career_pathways')
            ->join('career_pathways', 'course_career_pathways.career_pathway_id', '=', 'career_pathways.id')
            ->join('courses', 'course_career_pathways.course_id', '=', 'courses.id')
            ->whereIn('career_pathways.riasec_id', $riasec_scores)
            ->select('career_pathways.riasec_id', 'courses.course_name', 'career_pathways.career_name')
            ->get();

        $groupedRelatedCourses = [];
        foreach ($relatedCourses as $course) {
            $groupedRelatedCourses[$course->riasec_id][$course->career_name][] = $course->course_name;
        }

        $grouped_users = $users->groupBy('fullname');

        return view('admin.analytics.analytics', compact('grouped_users', 'riasec_scores', 'groupedRelatedCourses'));
    }
}
