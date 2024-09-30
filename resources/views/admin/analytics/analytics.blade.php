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

    <h1>Analytics determining career field of each users</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>RIASEC Type</th>
                <th>Career Pathway</th>
                <th>Related Course</th>
                <th>Preferred Course</th>
                <th>Total Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grouped_users as $fullname => $scores)
                @php
                    $sorted_scores = $scores->sortByDesc('total_points');
                    $grouped_by_riasec = $sorted_scores->groupBy('riasec_id');
                @endphp
            
                @foreach ($grouped_by_riasec as $riasec_id => $group)
                    @php
                        $career_names = $group->pluck('career_name')->implode(', ');
                        $total_points = $group->first()->total_points;
                        $courses = array_filter([
                            $group->first()->course_1,
                            $group->first()->course_2,
                            $group->first()->course_3,
                        ]);
                        $course_names = implode(', ', $courses);
                        $related_courses = $group->first()->related_courses;
                    @endphp
                    <tr>
                        <td>{{ $loop->first ? $fullname : '' }}</td>
                        <td>{{ $riasec_id }}</td>
                        <td>{{ $career_names }}</td>
                        <td>{{ $related_courses }}</td>
                        <td>{{ $course_names }}</td>
                        <td>{{ $total_points }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    
    
</body>
</html>
