<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function AnalyticsPage()
    {
        $userScores = DB::table('riasec_scores')
            ->select('user_id', 'riasec_id', DB::raw('SUM(points) as total_points'))
            ->groupBy('user_id', 'riasec_id')
            ->orderByDesc('total_points')
            ->get();
    
        // Group scores by user
        $groupedUserScores = [];
        foreach ($userScores as $score) {
            $groupedUserScores[$score->user_id][$score->riasec_id] = $score->total_points;
        }
    
        // Get top 3 scores for each user
        $topScores = [];
        foreach ($groupedUserScores as $userId => $scores) {
            arsort($scores);
            $topScores[$userId] = array_slice($scores, 0, 3, true);
        }
    
        // Fetch user names and preferred courses
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
    
        return view('admin.analytics.analytics', compact('topScores', 'users', 'suggestedCourses', 'preferredCourses'));
    }

    private function getCourseName($courseId)
    {
        return DB::table('courses')->where('id', $courseId)->value('course_name') ?? 'N/A';
    }
    
    

    public function GetExaminersDataByGender()
    {
        $data = DB::table('users')
            ->select('gender', DB::raw('COUNT(*) as count'))
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
}
