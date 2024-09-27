<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function CoursePage()
    {
        $course = Course::all();
        return view('admin.course.course', compact('course'));
    }

    public function AddCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|max:255',
            'course_description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.course.page')->withErrors($validator)->withInput();
        }

        Course::create([
            'course_name' => $request->input('course_name'),
            'course_description' => $request->input('course_description'),
        ]);

        return redirect()->route('admin.course.page')->with('success', 'Course added successfully');
    }

    public function DeleteCourse($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return redirect()->route('admin.course.page')->with('success', 'Course deleted successfully');
        }
        return redirect()->route('admin.course.page')->with('error', 'Course not found');
    }
}
