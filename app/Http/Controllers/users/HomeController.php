<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomePage()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            if ($course->course_picture) {
                $course->course_picture = json_decode($course->course_picture, true);
            }
        }

        return view('default', compact('courses'));
    }

    public function ShowCourse($id)
    {
        $course = Course::findOrFail($id);
        if ($course->course_picture) {
            $course->course_picture = json_decode($course->course_picture, true);
        }
        return view('show_course', compact('course'));
    }
}
