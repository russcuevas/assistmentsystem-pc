<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CareerPathway;
use App\Models\Course;
use App\Models\CourseCareerPathway;
use App\Models\Riasec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiasecController extends Controller
{
    public function RiasecPage()
    {
        $riasec = DB::table('riasecs')
            ->leftJoin('career_pathways', 'riasecs.id', '=', 'career_pathways.riasec_id')
            ->leftJoin('course_career_pathways', 'career_pathways.id', '=', 'course_career_pathways.career_pathway_id')
            ->leftJoin('courses', 'course_career_pathways.course_id', '=', 'courses.id')
            ->select(
                'riasecs.id as riasec_id',
                'riasecs.riasec_name',
                'riasecs.description',
                'riasecs.created_at',
                'riasecs.updated_at',
                'career_pathways.career_name',
                DB::raw('GROUP_CONCAT(courses.course_name ORDER BY courses.course_name SEPARATOR ", ") as course_names')
            )
            ->groupBy('riasecs.id', 'riasecs.riasec_name', 'riasecs.description', 'riasecs.created_at', 'riasecs.updated_at', 'career_pathways.career_name')
            ->get();

        $formattedRiasec = [];
        foreach ($riasec as $item) {
            if (!isset($formattedRiasec[$item->riasec_name])) {
                $formattedRiasec[$item->riasec_name] = [
                    'id' => $item->riasec_id,
                    'description' => $item->description,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'careers' => []
                ];
            }
            $formattedRiasec[$item->riasec_name]['careers'][] = [
                'name' => $item->career_name,
                'courses' => $item->course_names ? explode(', ', $item->course_names) : []
            ];
        }
        $courses = Course::all();
        return view('admin.riasec.riasec', compact('formattedRiasec', 'courses'));
    }



    public function AddRiasec(Request $request)
    {
        $request->validate([
            'riasec_id' => 'required|string|max:1|unique:riasecs,id',
            'riasec_name' => 'required|string|max:255',
            'description' => 'required|string',
            'career_name.*' => 'required|string|max:255',
            'course_id.*.*' => 'exists:courses,id',
        ]);

        $riasec = Riasec::create([
            'id' => $request->riasec_id,
            'riasec_name' => $request->riasec_name,
            'description' => $request->description,
        ]);

        foreach ($request->career_name as $index => $careerName) {
            $careerPathway = CareerPathway::create([
                'riasec_id' => $riasec->id,
                'career_name' => $careerName,
            ]);

            if (isset($request->course_id[$index])) {
                foreach ($request->course_id[$index] as $courseId) {
                    CourseCareerPathway::create([
                        'career_pathway_id' => $careerPathway->id,
                        'course_id' => $courseId,
                    ]);
                }
            }
        }

        return response()->json(['status' => 'success', 'message' => 'RIASEC added successfully']);
    }

    public function EditRiasec($id)
    {
        $riasec = DB::table('riasecs')->where('id', $id)->first();

        $careerPathways = DB::table('career_pathways')
            ->where('riasec_id', $id)
            ->get();

        foreach ($careerPathways as $careerPathway) {
            $careerPathway->courses = DB::table('course_career_pathways')
                ->where('career_pathway_id', $careerPathway->id)
                ->pluck('course_id')
                ->toArray();
        }

        $courses = DB::table('courses')->get();

        return view('admin.riasec.edit_riasec', compact('riasec', 'careerPathways', 'courses'));
    }


    public function UpdateRiasec(Request $request, $id)
    {
        $request->validate([
            'riasec_id' => 'required|string|max:1|unique:riasecs,id,' . $id,
            'riasec_name' => 'required|string|max:255',
            'description' => 'required|string',
            'career_name.*' => 'required|string|max:255',
            'course_id.*.*' => 'exists:courses,id',
        ]);

        DB::table('riasecs')->where('id', $id)->update([
            'id' => $request->riasec_id,
            'riasec_name' => $request->riasec_name,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        DB::table('career_pathways')->where('riasec_id', $id)->delete();

        foreach ($request->career_name as $index => $careerName) {
            $careerPathwayId = DB::table('career_pathways')->insertGetId([
                'riasec_id' => $request->riasec_id,
                'career_name' => $careerName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (isset($request->course_id[$index])) {
                foreach ($request->course_id[$index] as $courseId) {
                    DB::table('course_career_pathways')->insert([
                        'career_pathway_id' => $careerPathwayId,
                        'course_id' => $courseId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('admin.riasec.page')->with('success', 'RIASEC updated successfully!');
    }

    public function DeleteRiasec($id)
    {
        $questionIds = DB::table('questions')
            ->where('riasec_id', $id)
            ->pluck('id');
        DB::table('responses')->whereIn('question_id', $questionIds)->delete();
        DB::table('questions')->where('riasec_id', $id)->delete();
        DB::table('riasec_scores')->where('riasec_id', $id)->delete();
        $careerPathwayIds = DB::table('career_pathways')
            ->where('riasec_id', $id)
            ->pluck('id');
        DB::table('course_career_pathways')->whereIn('career_pathway_id', $careerPathwayIds)->delete();
        DB::table('career_pathways')->where('riasec_id', $id)->delete();
        DB::table('riasecs')->where('id', $id)->delete();

        return redirect()->route('admin.riasec.page')->with('success', 'RIASEC deleted successfully!');
    }
}
