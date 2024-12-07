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
            'course_name' => 'required|string|max:255|unique:courses,course_name',
            'course_description' => 'required|string',
            'course_pictures' => 'nullable|array',
            'course_pictures.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $fileNames = [];
        if ($request->hasFile('course_pictures')) {
            foreach ($request->file('course_pictures') as $file) {
                $fileNames[] = $file->hashName();
                $file->storeAs('course/course_picture', $file->hashName(), 'public');
            }
        }

        $course = Course::create([
            'course_name' => $request->input('course_name'),
            'course_description' => $request->input('course_description'),
            'course_picture' => $fileNames ? json_encode($fileNames) : null,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Course added successfully']);
    }




    public function UpdateCourse(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|max:255|unique:courses,course_name,' . $id,
            'course_description' => 'required|string',
            'course_pictures' => 'nullable|array',
            'course_pictures.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $course = Course::find($id);
        if ($course) {
            // Handle file uploads (add new pictures or keep existing ones)
            $existingPictures = json_decode($course->course_picture, true) ?? []; // Get existing images (if any)
            $fileNames = $existingPictures; // Keep existing images if no new ones are uploaded

            // If new images are uploaded, replace the old ones
            if ($request->hasFile('course_pictures')) {
                // Delete old images
                foreach ($existingPictures as $oldImage) {
                    $oldImagePath = public_path('storage/course/course_picture' . $oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Delete the old image file
                    }
                }

                // Store the new images and save their names
                $fileNames = [];
                foreach ($request->file('course_pictures') as $file) {
                    $fileName = $file->hashName(); // Generate a unique file name
                    $file->storeAs('course/course_picture', $fileName, 'public'); // Store the file
                    $fileNames[] = $fileName; // Add the file name to the array
                }
            }

            // Update the course with the new data and images
            $course->update([
                'course_name' => $request->input('course_name'),
                'course_description' => $request->input('course_description'),
                'course_picture' => $fileNames ? json_encode($fileNames) : null, // Store the image names as a JSON array
            ]);

            return response()->json(['status' => 'success', 'message' => 'Course updated successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Course not found'], 404);
    }


    public function DeleteCourse($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return response()->json(['status' => 'success', 'message' => 'Course deleted successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Course not found'], 404);
    }
}
