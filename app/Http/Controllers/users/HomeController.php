<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomePage()
    {
        $courses = Course::paginate(6);

        foreach ($courses as $course) {
            if ($course->course_picture) {
                $course->course_picture = json_decode($course->course_picture, true);
            }
        }

        return view('default', compact('courses'));
    }

    public function ShowCourse($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->route('default.page');
        }

        if ($course->course_picture) {
            $course->course_picture = json_decode($course->course_picture, true);
        }

        return view('show_course', compact('course'));
    }
}
