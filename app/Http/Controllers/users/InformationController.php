<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\PreferredCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InformationController extends Controller
{
    public function ExaminersInformationPage()
    {
        $examiners = Auth::guard('users')->user();
        $courses = Course::all();
        return view('users.information.information', compact('examiners', 'courses'));
    }

    public function AddInformation(Request $request)
    {
        $request->validate([
            'fullname' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
            'email' => 'nullable|email|max:255|unique:users,email,',
            'age' => 'nullable|string|max:3',
            'birthday' => 'nullable|date',
            'strand' => 'nullable|string|max:255',
            'course_1' => 'nullable|exists:courses,id',
            'course_2' => 'nullable|exists:courses,id',
            'course_3' => 'nullable|exists:courses,id',
        ]);

        // Getting the auth user
        $user = Auth::guard('users')->user();

        $birthday = $request->input('birthday');
        if ($birthday) {
            $formatted_password = date('Ymd', strtotime($birthday));
        } else {
            $formatted_password = $user->password;
        }

        // Update the user details
        $user->update([
            'fullname' => $request->input('fullname'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'age' => $request->input('age'),
            'birthday' => $request->input('birthday'),
            'strand' => $request->input('strand'),
            'password' => Hash::make($formatted_password),
        ]);

        // Insert or update in chosen_course table
        PreferredCourse::updateOrCreate(
            ['user_id' => $user->id],
            [
                'course_1' => $request->input('course_1'),
                'course_2' => $request->input('course_2'),
                'course_3' => $request->input('course_3'),
            ]
        );

        return redirect()->route('users.examination.page')->with('success');
    }
}
