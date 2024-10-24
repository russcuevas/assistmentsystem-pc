<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{


    public function GetExaminersDataByGender(Request $request)
    {
        $year = $request->query('year', date('Y'));
        $data = DB::table('users')
            ->select('gender', DB::raw('COUNT(*) as count'))
            ->whereYear('updated_at', $year)
            ->groupBy('gender')
            ->get();

        return response()->json($data);
    }


    public function GetOfferedCourses()
    {
        $offered_courses = DB::table('courses')
            ->select('course_name', DB::raw('COUNT(*) as count'))
            ->groupBy('course_name')
            ->pluck('count', 'course_name')
            ->toArray();

        return response()->json(['offered_courses' => $offered_courses]);
    }

    public function GetPreferredCourseCounts()
    {
        $preferredCourses = DB::table('preferred_courses')
            ->select('course_1 as course_id')
            ->whereNotNull('course_1')
            ->groupBy('course_id')
            ->selectRaw('count(*) as count')
            ->unionAll(
                DB::table('preferred_courses')
                    ->select('course_2 as course_id')
                    ->whereNotNull('course_2')
                    ->groupBy('course_id')
                    ->selectRaw('count(*) as count')
            )
            ->unionAll(
                DB::table('preferred_courses')
                    ->select('course_3 as course_id')
                    ->whereNotNull('course_3')
                    ->groupBy('course_id')
                    ->selectRaw('count(*) as count')
            )
            ->get();

        $course_counts = [];
        foreach ($preferredCourses as $course) {
            $courseName = DB::table('courses')->where('id', $course->course_id)->value('course_name');
            if ($courseName) {
                if (isset($course_counts[$courseName])) {
                    $course_counts[$courseName] += $course->count;
                } else {
                    $course_counts[$courseName] = $course->count;
                }
            }
        }

        arsort($course_counts);
        $topCourses = array_slice($course_counts, 0, 3, true);

        return response()->json($topCourses);
    }

    public function GetRiasecScores(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $data = $this->getRiasecData($year);
        return response()->json($data);
    }

    private function getRiasecData($year)
    {
        $riasecData = [];
        $chartData = [];
        $userScores = DB::table('riasec_scores')
            ->whereYear('created_at', $year)
            ->select('riasec_id', DB::raw('SUM(points) as total_points'))
            ->groupBy('riasec_id')
            ->orderByDesc('total_points')
            ->get();

        foreach ($userScores as $score) {
            $totalPoints = $score->total_points;

            $riasecData[$score->riasec_id] = [
                'total_points' => $totalPoints,
                'courses' => []
            ];

            $courses = DB::table('course_career_pathways')
                ->join('career_pathways', 'course_career_pathways.career_pathway_id', '=', 'career_pathways.id')
                ->join('courses', 'course_career_pathways.course_id', '=', 'courses.id')
                ->where('career_pathways.riasec_id', $score->riasec_id)
                ->select('courses.course_name', 'career_pathways.career_name')
                ->get();

            foreach ($courses as $course) {
                $riasecData[$score->riasec_id]['courses'][$course->career_name][] = $course->course_name;
            }

            $formattedCourses = [];
            foreach ($riasecData[$score->riasec_id]['courses'] as $career_name => $course_names) {
                $formattedCourses[] = "{$career_name}: " . implode(', ', $course_names);
            }

            $chartData[] = [
                'riasec' => "{$score->riasec_id}: ($totalPoints)",
                'points' => $totalPoints,
                'courses' => implode('<br>', $formattedCourses)
            ];
        }

        return ['riasecData' => $riasecData, 'chartData' => $chartData];
    }
}
