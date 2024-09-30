<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User RIASEC Analytics</title>
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="{{ route('admin.dashboard.page')}}">Dashboard</a><br>
                <a href="{{ route('admin.admin.management.page') }}">Admin Management</a><br>
                <a href="{{ route('admin.examiners.page')}}">Examiners Management</a><br>
                <a href="{{ route('admin.riasec.page')}}">Riasec Management</a><br>
                <a href="{{ route('admin.course.page') }}">Course Management</a><br>
                <a href="{{ route('admin.questionnaire.page')}}">Questionnaire Management</a><br>
                <a href="{{ route('admin.analytics.page')}}">Analytics</a><br>
                <a href="{{ route('admin.logout.request') }}">Logout</a><br>
            </li>
        </ul>
    </nav>

    <h1>Analytics determining career field of each user</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>Preferred Course</th>
                <th>RIASEC</th>
                <th>Related Course</th>
                <th>Total Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grouped_users as $fullname => $scores)
                @php
                    $currentRiasecId = null;
                    $isFirstRow = true;
                    $preferredCourseDisplayed = false;
                @endphp

                @foreach ($scores as $score)
                    <tr>
                        @if ($currentRiasecId !== $score->riasec_id)
                            <td>{{ $isFirstRow ? $fullname : '' }}</td>
                            <td>
                                @if (!$preferredCourseDisplayed)
                                    @php
                                        $preferredCourses = array_filter([$score->course_1_name, $score->course_2_name, $score->course_3_name]);
                                    @endphp
                                    @foreach ($preferredCourses as $course)
                                        {{ $course }}<br>
                                    @endforeach
                                    @php $preferredCourseDisplayed = true; @endphp
                                @endif
                            </td>
                            <td>{{ $score->riasec_id }} = {{ $score->riasec_name }}</td>                
                            <td>
                                @if (isset($groupedRelatedCourses[$score->riasec_id]))
                                    @foreach ($groupedRelatedCourses[$score->riasec_id] as $career_name => $courses)
                                        {{ $career_name }}:<br>
                                        @foreach ($courses as $course)
                                            <span style="{{ in_array($course, array_filter([$score->course_1_name, $score->course_2_name, $score->course_3_name])) ? 'color: red;' : '' }}">
                                                {{ $course }}
                                            </span><br>
                                        @endforeach
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $score->total_points }}</td>
                            @php $isFirstRow = false; @endphp
                        @endif
                    </tr>
                    @php $currentRiasecId = $score->riasec_id; @endphp
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
