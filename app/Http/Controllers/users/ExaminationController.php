<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExaminationController extends Controller
{
    public function ExaminationPage()
    {
        $user = Auth::guard('users')->user();
        if (!$user) {
            return redirect()->route('users.information.page')->with('error', 'You must be logged in to access the examination.');
        }
        $questions = Question::all();
        $options = Option::all();
        return view('users.examination.examination', compact('questions', 'options', 'user'));
    }


    public function SubmitResponses(Request $request)
    {
        $user = Auth::guard('users')->user();

        $request->validate([
            'answer.*' => 'nullable|in:true,false',
        ]);

        foreach ($request->input('answer') as $question_id => $answer) {
            $question = Question::find($question_id);
            if ($question && in_array($question->riasec_id, ['R', 'I', 'A', 'S', 'E', 'C'])) {
                $selected_option_id = null;

                if ($answer === 'true') {
                    $selectedOption = Option::where('question_id', $question_id)
                        ->where('option_text', $question->riasec_id)
                        ->first();

                    if ($selectedOption) {
                        $selected_option_id = $selectedOption->id;
                    }
                }

                Response::create([
                    'user_id' => $user->id,
                    'question_id' => $question_id,
                    'selected_option_id' => $selected_option_id,
                    'is_correct' => $answer === 'true',
                ]);

                DB::table('riasec_scores')->updateOrInsert(
                    ['user_id' => $user->id, 'riasec_id' => $question->riasec_id],
                    [
                        'points' => DB::raw("points + " . ($answer === 'true' ? 1 : 0)),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }
        }

        return redirect()->route('users.completed.page')->with('success', 'Your responses have been submitted.');
    }

    public function ExaminationCompletedPage()
    {
        $user = Auth::guard('users')->user();
        $scores = DB::table('riasec_scores')
            ->select('riasec_id', DB::raw('SUM(points) as total_points'))
            ->where('user_id', $user->id)
            ->groupBy('riasec_id')
            ->orderBy('total_points', 'desc')
            ->take(3)
            ->get();

        $all_scores = DB::table('riasec_scores')
            ->where('user_id', $user->id)
            ->pluck('points', 'riasec_id');

        $preferredCoursesData = DB::table('preferred_courses')
            ->where('user_id', $user->id)
            ->select('course_1', 'course_2', 'course_3')
            ->first();

        $preferredCourseIds = array_filter([
            $preferredCoursesData->course_1 ?? 'N/A',
            $preferredCoursesData->course_2 ?? 'N/A',
            $preferredCoursesData->course_3 ?? 'N/A',
        ]);

        $preferredCourses = DB::table('course_career_pathways')
            ->join('career_pathways', 'course_career_pathways.career_pathway_id', '=', 'career_pathways.id')
            ->join('courses', 'course_career_pathways.course_id', '=', 'courses.id')
            ->whereIn('career_pathways.riasec_id', $scores->pluck('riasec_id'))
            ->select('courses.id', 'courses.course_name', 'career_pathways.career_name')
            ->get();

        $groupedPreferredCourses = [];
        foreach ($preferredCourses as $course) {
            $groupedPreferredCourses[$course->career_name][] = [
                'id' => $course->id,
                'name' => $course->course_name,
            ];
        }

        return view('users.examination.exam_completed', compact('scores', 'all_scores', 'groupedPreferredCourses', 'preferredCourseIds'));
    }
}
