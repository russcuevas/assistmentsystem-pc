<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ExaminersController extends Controller
{
    public function ExaminersPage()
    {
        $available_default_id = User::all();
        $default_id = User::pluck('default_id')->toArray();
        $next_id = !empty($default_id) ? max($default_id) + 1 : 1;

        $examiners = DB::table('users')
            ->leftJoin('preferred_courses', 'users.id', '=', 'preferred_courses.user_id')
            ->leftJoin('courses as course_1', 'preferred_courses.course_1', '=', 'course_1.id')
            ->leftJoin('courses as course_2', 'preferred_courses.course_2', '=', 'course_2.id')
            ->leftJoin('courses as course_3', 'preferred_courses.course_3', '=', 'course_3.id')
            ->select(
                'users.id',
                'users.default_id',
                'users.fullname',
                'users.gender',
                'users.age',
                'users.birthday',
                'users.strand',
                'course_1.course_name as course_1_name',
                'course_2.course_name as course_2_name',
                'course_3.course_name as course_3_name'
            )
            ->get();

        return view('admin.examiners.examiners', compact('available_default_id', 'default_id', 'next_id', 'examiners'));
    }

    public function DefaultIDPage()
    {
        $available_default_id = User::all();
        $default_id = User::pluck('default_id')->toArray();
        $next_id = !empty($default_id) ? max($default_id) + 1 : 1;

        $examiners = DB::table('users')
            ->leftJoin('preferred_courses', 'users.id', '=', 'preferred_courses.user_id')
            ->leftJoin('courses as course_1', 'preferred_courses.course_1', '=', 'course_1.id')
            ->leftJoin('courses as course_2', 'preferred_courses.course_2', '=', 'course_2.id')
            ->leftJoin('courses as course_3', 'preferred_courses.course_3', '=', 'course_3.id')
            ->select(
                'users.id',
                'users.default_id',
                'users.fullname',
                'users.gender',
                'users.age',
                'users.birthday',
                'users.strand',
                'course_1.course_name as course_1_name',
                'course_2.course_name as course_2_name',
                'course_3.course_name as course_3_name'
            )
            ->get();

        return view('admin.default_id.default_id', compact('available_default_id', 'default_id', 'next_id', 'examiners'));
    }

    public function ExaminersAccountAdd(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:1',
            'default_id' => 'required|integer',
        ]);

        $count = (int) $request->input('count');
        $starting_id = (int) $request->input('default_id');
        $created_id = [];

        for ($i = 0; $i < $count; $i++) {
            $newId = $starting_id + $i;

            if (User::where('default_id', $newId)->exists()) {
                return redirect()->back()->withErrors(['default_id' => "Default ID $newId already exists. Please choose a different starting ID."]);
            }

            User::create([
                'default_id' => $newId,
                'password' => Hash::make('ub1234')
            ]);

            $created_id[] = $newId;
        }

        return redirect()->route('admin.default.id.page')->with('success', 'Default IDs added successfully: ' . implode(', ', $created_id));
    }

    public function ExaminersListDelete($id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            $user->delete();
            return redirect()->route('admin.examiners.page')->with('success', 'Examiner deleted successfully');
        }

        return redirect()->route('admin.examiners.page')->with('error', 'Examiner not found');
    }

    public function ExaminersDefaultIdDelete($default_id)
    {
        $user = User::where('default_id', $default_id)->first();

        if ($user) {
            $user->delete();
            return redirect()->route('admin.default.id.page')->with('success', 'Examiner deleted successfully');
        }

        return redirect()->route('admin.default.id.page')->with('error', 'Examiner not found');
    }
}
