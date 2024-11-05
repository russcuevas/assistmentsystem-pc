<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultsController extends Controller
{
    public function ResultsPage()
    {
        $users = DB::table('users')->get();
        $usersData = [];

        foreach ($users as $user) {
            $scores = DB::table('riasec_scores')
                ->select('riasec_id', DB::raw('SUM(points) as total_points'))
                ->where('user_id', $user->id)
                ->groupBy('riasec_id')
                ->orderBy('total_points', 'desc')
                ->take(3)
                ->get();

            $preferredCoursesData = DB::table('preferred_courses')
                ->where('user_id', $user->id)
                ->select('course_1', 'course_2', 'course_3')
                ->first();

            $preferredCourseIds = array_filter([
                $preferredCoursesData->course_1 ?? null,
                $preferredCoursesData->course_2 ?? null,
                $preferredCoursesData->course_3 ?? null,
            ]);

            $preferredCourseNames = DB::table('courses')
                ->whereIn('id', $preferredCourseIds)
                ->pluck('course_name')
                ->toArray();

            $preferredCourses = DB::table('course_career_pathways')
                ->join('career_pathways', 'course_career_pathways.career_pathway_id', '=', 'career_pathways.id')
                ->join('courses', 'course_career_pathways.course_id', '=', 'courses.id')
                ->join('riasecs', 'career_pathways.riasec_id', '=', 'riasecs.id')
                ->whereIn('career_pathways.riasec_id', $scores->pluck('riasec_id'))
                ->select('courses.id', 'courses.course_name', 'career_pathways.career_name', 'career_pathways.riasec_id', 'riasecs.riasec_name')
                ->get();

            $groupedPreferredCourses = [];
            foreach ($preferredCourses as $course) {
                $groupedPreferredCourses[$course->riasec_id][$course->career_name][] = [
                    'id' => $course->id,
                    'name' => $course->course_name,
                    'riasec_name' => $course->riasec_name
                ];
            }

            $usersData[] = [
                'user' => $user,
                'scores' => $scores,
                'preferredCourseNames' => $preferredCourseNames,
                'groupedPreferredCourses' => $groupedPreferredCourses
            ];
        }

        return view('admin.results.exam_results', compact('usersData'));
    }

    public function GetExaminersResults($userId)
    {
        $user = DB::table('users')->find($userId);
    
        $scores = DB::table('riasec_scores')
            ->select('riasec_id', DB::raw('SUM(points) as total_points'))
            ->where('user_id', $user->id)
            ->groupBy('riasec_id')
            ->orderBy('total_points', 'desc')
            ->get();
    
        $preferredCoursesData = DB::table('preferred_courses')
            ->where('user_id', $user->id)
            ->select('course_1', 'course_2', 'course_3')
            ->first();
    
        $preferredCourseIds = array_filter([
            $preferredCoursesData->course_1 ?? null,
            $preferredCoursesData->course_2 ?? null,
            $preferredCoursesData->course_3 ?? null,
        ]);
    
        $preferredCourseNames = DB::table('courses')
            ->whereIn('id', $preferredCourseIds)
            ->pluck('course_name')
            ->toArray();
    
        $preferredCourses = DB::table('course_career_pathways')
            ->join('career_pathways', 'course_career_pathways.career_pathway_id', '=', 'career_pathways.id')
            ->join('courses', 'course_career_pathways.course_id', '=', 'courses.id')
            ->join('riasecs', 'career_pathways.riasec_id', '=', 'riasecs.id')
            ->whereIn('career_pathways.riasec_id', $scores->pluck('riasec_id'))
            ->select('courses.id', 'courses.course_name', 'career_pathways.career_name', 'career_pathways.riasec_id', 'riasecs.riasec_name')
            ->get();
    
        $groupedPreferredCourses = [];
        foreach ($preferredCourses as $course) {
            $groupedPreferredCourses[$course->riasec_id][$course->career_name][] = [
                'id' => $course->id,
                'name' => $course->course_name,
                'riasec_name' => $course->riasec_name
            ];
        }
    
        return view('admin.results.results_view', compact('user', 'scores', 'preferredCourseNames', 'groupedPreferredCourses', 'preferredCourseIds'));
    }
    
    public function GetExaminersMonthYear(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
    
        $query = DB::table('users');

        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        if ($year) {
            $query->whereYear('created_at', $year);
        }
    
        $users = $query->get();
        $usersData = [];
    
        foreach ($users as $user) {
            $scores = DB::table('riasec_scores')
                ->select('riasec_id', DB::raw('SUM(points) as total_points'))
                ->where('user_id', $user->id)
                ->groupBy('riasec_id')
                ->orderBy('total_points', 'desc')
                ->take(3)
                ->get();
    
            $preferredCoursesData = DB::table('preferred_courses')
                ->where('user_id', $user->id)
                ->select('course_1', 'course_2', 'course_3')
                ->first();
    
            $preferredCourseIds = array_filter([
                $preferredCoursesData->course_1 ?? null,
                $preferredCoursesData->course_2 ?? null,
                $preferredCoursesData->course_3 ?? null,
            ]);
    
            $preferredCourseNames = DB::table('courses')
                ->whereIn('id', $preferredCourseIds)
                ->pluck('course_name')
                ->toArray();
    
            $preferredCourses = DB::table('course_career_pathways')
                ->join('career_pathways', 'course_career_pathways.career_pathway_id', '=', 'career_pathways.id')
                ->join('courses', 'course_career_pathways.course_id', '=', 'courses.id')
                ->join('riasecs', 'career_pathways.riasec_id', '=', 'riasecs.id')
                ->whereIn('career_pathways.riasec_id', $scores->pluck('riasec_id'))
                ->select('courses.id', 'courses.course_name', 'career_pathways.career_name', 'career_pathways.riasec_id', 'riasecs.riasec_name')
                ->get();
    
            $groupedPreferredCourses = [];
            foreach ($preferredCourses as $course) {
                $groupedPreferredCourses[$course->riasec_id][$course->career_name][] = [
                    'id' => $course->id,
                    'name' => $course->course_name,
                    'riasec_name' => $course->riasec_name
                ];
            }
    
            $usersData[] = [
                'user' => $user,
                'scores' => $scores,
                'preferredCourseNames' => $preferredCourseNames,
                'groupedPreferredCourses' => $groupedPreferredCourses
            ];
        }
    
        return view('admin.results.exam_results', compact('usersData', 'month', 'year'));
    }
    
}

