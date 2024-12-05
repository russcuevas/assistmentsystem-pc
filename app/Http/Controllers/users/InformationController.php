<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\PreferredCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InformationController extends Controller
{
    public function ExaminersInformationPage()
    {
        $examiners = Auth::guard('users')->user();
        $has_scores = DB::table('riasec_scores')->where('user_id', $examiners->id)->exists();

        if ($has_scores) {
            return redirect()->route('users.completed.page');
        }
        $courses = Course::all();
        return view('users.information.information', compact('examiners', 'courses'));
    }

    public function AddInformation(Request $request)
    {
        // Get the current authenticated user
        $user = Auth::guard('users')->user();

        // Validate only the courses
        $request->validate([
            'course_1' => 'nullable|exists:courses,id',
            'course_2' => 'nullable|exists:courses,id',
            'course_3' => 'nullable|exists:courses,id',
        ]);

        // Update or create the user's preferred courses
        PreferredCourse::updateOrCreate(
            ['user_id' => $user->id],
            [
                'course_1' => $request->input('course_1'),
                'course_2' => $request->input('course_2'),
                'course_3' => $request->input('course_3'),
            ]
        );

        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Courses updated successfully.',
            'redirect' => route('users.examination.page')
        ]);
    }
}
