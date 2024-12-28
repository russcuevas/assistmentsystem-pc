<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomePage()
    {
        // Fetch all courses from the database
        $courses = Course::all();

        // Decode the course_picture field for each course
        foreach ($courses as $course) {
            // Decode the course_picture if it's not empty
            if ($course->course_picture) {
                $course->course_picture = json_decode($course->course_picture, true);
            }
        }

        return view('default', compact('courses'));
    }

    public function ShowCourse($id)
    {
        // Retrieve the course by its ID
        $course = Course::findOrFail($id);

        // Decode the course_picture field if it's not empty
        if ($course->course_picture) {
            $course->course_picture = json_decode($course->course_picture, true);
        }

        // Return the view with the course details
        return view('show_course', compact('course'));
    }
}
