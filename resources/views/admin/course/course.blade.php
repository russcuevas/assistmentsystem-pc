<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <h1>Course Management</h1>
    <button class="btn btn-success" data-toggle="modal" data-target="#addCourseModal">Add Course</button>
    <!-- Add Course Modal -->
    @include('admin.course.modals.add_course');

    <hr>
    <h1>Course List</h1>
    <div class="body">
        <table class="table">
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
                        <button class="btn btn-warning btn-sm" 
                                data-toggle="modal" 
                                data-target="#updateCourseModal{{ $available_course->id }}">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm" 
                                data-toggle="modal" 
                                data-target="#deleteCourseModal{{ $available_course->id }}">
                            Delete
                        </button>
                        
                        <!-- Edit Course Modal -->
                        @include('admin.course.modals.edit_course')
                        {{-- Delete Course Modal --}}
                        @include('admin.course.modals.delete_course')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
