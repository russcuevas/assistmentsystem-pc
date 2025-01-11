@php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;

    $user = Auth::guard('users')->user();
    if (!$user) {
        return redirect()->route('login');
    }

    $scores = DB::table('riasec_scores')
        ->select('riasec_id', DB::raw('SUM(points) as total_points'))
        ->where('user_id', $user->id)
        ->groupBy('riasec_id')
        ->orderBy('total_points', 'desc')
        ->get();

    $riasec_order = ['R', 'I', 'A', 'S', 'E', 'C'];

    $ordered_scores = [];
    foreach ($scores as $score) {
        $ordered_scores[$score->riasec_id] = $score->total_points;
    }

    arsort($ordered_scores);

    $top_scores = [];
    $top_count = 0;
    $last_score = null;

    foreach ($ordered_scores as $riasec_id => $total_points) {
        if ($top_count < 3 || $total_points == $last_score) {
            $top_scores[$riasec_id] = $total_points;
            $top_count++;
            $last_score = $total_points;
        }
    }

    $riasec_names = DB::table('riasecs')->pluck('riasec_name', 'id')->toArray();

    $all_scores = DB::table('riasec_scores')
        ->where('user_id', $user->id)
        ->pluck('points', 'riasec_id');

    $preferredCoursesData = DB::table('preferred_courses')
        ->where('user_id', $user->id)
        ->select('course_1', 'course_2', 'course_3')
        ->first();

    $preferredCourseIds = array_filter([
        $preferredCoursesData->course_1 ?? null,
        $preferredCoursesData->course_2 ?? null,
        $preferredCoursesData->course_3 ?? null,
    ]);

    $preferredCourseNames = DB::table('courses')
        ->whereIn('id', $preferredCourseIds)
        ->pluck('course_name')
        ->toArray();

    $preferredCourses = DB::table('course_career_pathways')
        ->join('career_pathways', 'course_career_pathways.career_pathway_id', '=', 'career_pathways.id')
        ->join('courses', 'course_career_pathways.course_id', '=', 'courses.id')
        ->join('riasecs', 'career_pathways.riasec_id', '=', 'riasecs.id')
        ->whereIn('career_pathways.riasec_id', $scores->pluck('riasec_id'))
        ->select('courses.id', 'courses.course_name', 'career_pathways.career_name', 'career_pathways.riasec_id', 'riasecs.riasec_name')
        ->get();

    $groupedPreferredCourses = [];
    foreach ($preferredCourses as $course) {
        $groupedPreferredCourses[$course->riasec_id][$course->career_name][] = [
            'id' => $course->id,
            'name' => $course->course_name,
            'riasec_name' => $course->riasec_name
        ];
    }
@endphp


<!DOCTYPE html>
<html>
<head>
    <title>Results Copy</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .blank-cell { background-color: red; }
        .footer { font-weight: bold; }
        .highlight { color: brown; font-weight: 900; }
    </style>
</head>
<body>
    <h1>Thank you for taking the exam.</h1>
    <p>Name: {{ $user->fullname }}</p>
    <p>Default ID: {{ $user->default_id }}</p>
    <p>Age: {{ $user->age }}</p>
    <p>Strand: {{ $user->strand }}</p>

    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>R</th>
                <th>I</th>
                <th>A</th>
                <th>S</th>
                <th>E</th>
                <th>C</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = [
                    'R' => 0,
                    'I' => 0,
                    'A' => 0,
                    'S' => 0,
                    'E' => 0,
                    'C' => 0,
                ];
            @endphp

            @foreach ($responses as $response)
                <tr>
                    <td>{{ $response['question'] }}</td>
                    @php
                        $isAllBlank = true; 
                        $cells = [
                            'R' => '',
                            'I' => '',
                            'A' => '',
                            'S' => '',
                            'E' => '',
                            'C' => ''
                        ];

                        if ($response['riasec_id'] === 'R' && $response['answer'] === '✓') {
                            $cells['R'] = 'True';
                            $count['R']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'I' && $response['answer'] === '✓') {
                            $cells['I'] = 'True';
                            $count['I']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'A' && $response['answer'] === '✓') {
                            $cells['A'] = 'True';
                            $count['A']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'S' && $response['answer'] === '✓') {
                            $cells['S'] = 'True';
                            $count['S']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'E' && $response['answer'] === '✓') {
                            $cells['E'] = 'True';
                            $count['E']++;
                            $isAllBlank = false;
                        }
                        if ($response['riasec_id'] === 'C' && $response['answer'] === '✓') {
                            $cells['C'] = 'True';
                            $count['C']++;
                            $isAllBlank = false;
                        }
                    @endphp
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['R'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['I'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['A'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['S'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['E'] }}</td>
                    <td class="{{ $isAllBlank ? 'blank-cell' : '' }}">{{ $cells['C'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <tfoot>
            <tr class="footer">
                <td>Total</td>
                <td>{{ $count['R'] }}</td>
                <td>{{ $count['I'] }}</td>
                <td>{{ $count['A'] }}</td>
                <td>{{ $count['S'] }}</td>
                <td>{{ $count['E'] }}</td>
                <td>{{ $count['C'] }}</td>
            </tr>
            <tr>
                <td></td>
                <td>R</td>
                <td>I</td>
                <td>A</td>
                <td>S</td>
                <td>E</td>
                <td>C</td>
            </tr>
        </tfoot>
    </table>

    <h6 style="color: brown; font-weight: 900; font-size: 20px">SUGGESTED COURSE</h6>
    <ul>
        @foreach ($top_scores as $riasec_id => $total_points)
            @if (isset($groupedPreferredCourses[$riasec_id]))
                <li>
                    @php
                        $firstCareer = array_key_first($groupedPreferredCourses[$riasec_id]);
                    @endphp
                    <strong>{{ $groupedPreferredCourses[$riasec_id][$firstCareer][0]['riasec_name'] }}</strong>
                    @foreach ($groupedPreferredCourses[$riasec_id] as $careerName => $courses)
                        <div>{{ $careerName }}: 
                            @foreach ($courses as $course)
                                <div>{{ $course['name'] }}</div>
                            @endforeach
                        </div>
                    @endforeach
                </li>
            @endif
        @endforeach
    </ul>
</body>
</html>
