<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/HoldOn.css') }}">
    <style>
        .loading-message {
            font-family: 'Arial', sans-serif;
        }

    </style>
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
    
    <h1>Add default ID</h1>
    <button class="btn btn-success" data-toggle="modal" data-target="#addDefaultIdModal">Add Default ID</button>
    {{-- Add Default ID Modal --}}
    @include('admin.examiners.modals.add_default_id')

    <table>
        <thead>
            <tr>
                <th>Default ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($available_default_id as $default_id)
            <tr>
                <td>{{ $default_id->default_id }}</td>
                <td>
                    @if(empty($default_id->fullname))
                    <button class="btn btn-danger btn-sm" 
                            data-toggle="modal" 
                            data-target="#deleteExaminersModal{{ $default_id->default_id }}">
                        Delete
                    </button>
                    @else
                        <span>Has records</span>
                    @endif
                    {{-- Delete Default ID Modal --}}
                    @include('admin.examiners.modals.delete_default_id')
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="4">No default id available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <hr>

    <h1>Examiners List</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Default ID</th>
                <th>Fullname</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Birthday</th>
                <th>Strand</th>
                <th>Preferred Course</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($examiners as $examiner)
                @if(!is_null($examiner->fullname) && !empty($examiner->fullname))
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $examiner->default_id }}</td>
                        <td>{{ $examiner->fullname }}</td>
                        <td>{{ $examiner->gender }}</td>
                        <td>{{ $examiner->age }}</td>
                        <td>{{ $examiner->birthday }}</td>
                        <td>{{ $examiner->strand }}</td>
                        <td>
                            1.) {{ $examiner->course_1_name ?? 'N/A' }} <br>
                            2.) {{ $examiner->course_2_name ?? 'N/A' }} <br>
                            3.) {{ $examiner->course_3_name ?? 'N/A' }} <br>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="8">No examiners available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin/js/HoldOn.js') }}"></script>
    <script>
        function showLoading() {
            HoldOn.open({
                theme: 'sk-circle',
                message: '<div class="loading-message">Please wait, adding ID...</div>',
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                textColor: '#fff'
            });
        }

        document.querySelector('form').onsubmit = function() {
            showLoading();
        };
    </script>
</body>
</html>