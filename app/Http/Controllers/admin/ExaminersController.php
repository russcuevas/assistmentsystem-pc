<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use PDF;
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
                'users.created_at',
                'users.updated_at',
                'course_1.course_name as course_1_name',
                'course_2.course_name as course_2_name',
                'course_3.course_name as course_3_name'
            )
            ->get();

        return view('admin.examiners.examiners', compact('available_default_id', 'default_id', 'next_id', 'examiners'));
    }

    public function GetExamineesMonthYear(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = DB::table('users')
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
                'users.created_at',
                'users.updated_at',
                'course_1.course_name as course_1_name',
                'course_2.course_name as course_2_name',
                'course_3.course_name as course_3_name'
            )
            ->whereNotNull('users.fullname')
            ->where('users.fullname', '<>', '');

        if ($month && $year) {
            $query->whereYear('users.created_at', $year)
                ->whereMonth('users.created_at', $month);
        } elseif ($year) {
            $query->whereYear('users.created_at', $year);
        } elseif ($month) {
            $query->whereMonth('users.created_at', $month);
        }

        $examiners = $query->get();

        return view('admin.examiners.examiners', compact('examiners', 'month', 'year'));
    }

    public function printExaminees(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = DB::table('users')
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
                'users.created_at',
                'users.updated_at',
                'course_1.course_name as course_1_name',
                'course_2.course_name as course_2_name',
                'course_3.course_name as course_3_name'
            )
            ->whereNotNull('users.fullname')
            ->where('users.fullname', '<>', '');

        if ($month && $year) {
            $query->whereYear('users.created_at', $year)
                ->whereMonth('users.created_at', $month);
        } elseif ($year) {
            $query->whereYear('users.created_at', $year);
        } elseif ($month) {
            $query->whereMonth('users.created_at', $month);
        }

        $examiners = $query->get();

        $data = [
            'title' => 'Examinees List',
            'date' => date('m/d/Y'),
            'examiners' => $examiners,
        ];

        $pdf = PDF::loadView('admin.examiners.print.print_examiners', $data);
        return $pdf->download('examinees_list.pdf');
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
                return response()->json(['errors' => ['default_id' => ["Default ID $newId already exists. Please choose a different starting ID."]]], 422);
            }

            User::create([
                'default_id' => $newId,
                'password' => Hash::make('ub1234')
            ]);

            $created_id[] = $newId;
        }

        return response()->json(['success' => 'Default IDs added successfully']);
    }


    public function ExaminersListDelete($id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            $user->delete();
            return response()->json(['success' => 'Examiners deleted successfully']);
        }

        return response()->json(['error' => 'Examiners ID not found'], 404);
    }

    public function ExaminersDefaultIdDelete($default_id)
    {
        $user = User::where('default_id', $default_id)->first();

        if ($user) {
            $user->delete();
            return response()->json(['success' => 'Default ID deleted successfully']);
        }

        return response()->json(['error' => 'Default ID not found'], 404);
    }


    public function ExaminersBulkDefaultIdDelete(Request $request)
    {
        $ids = $request->input('delete_selected_ids');

        if ($ids) {
            User::whereIn('default_id', $ids)->delete();
            return response()->json(['success' => 'Selected DefaultID deleted successfully']);
        }

        return response()->json(['error' => 'No DefaultID selected for deletion'], 400);
    }
}
