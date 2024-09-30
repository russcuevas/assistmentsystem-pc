<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    <h1>Add course</h1>
    <form action="{{ route('admin.add.course') }}" method="POST">
        @csrf
        <label for="">Course name</label><br>
        <input type="text" name="course_name"><br>
        <label for="">Course decription</label><br>
        <input type="text" name="course_description"><br>
        <input type="submit" value="Add course">
    </form>
    <br>
    <hr>
    <h1>Course List</h1>
        <div class="body">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Course Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course as $available_course)
                <tr>
                    <td>{{ $available_course->id }}</td>
                    <td>{{ $available_course->course_name }}</td>
                    <td>{{ $available_course->course_description }}</td>
                    <td>
                        <form action="{{ route('admin.delete.course', $available_course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>