<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

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

    <h1>Admin List</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdminModal">
        Add Admin
    </button>

    {{-- MODALS --}}
    <!-- Add Admin Modal -->
    @include('admin.admin_management.modals.admin_add_modal')

    <div class="body">
        <table class="table">
            <thead>
                <tr>
                    <th>Profile picture</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>
                        @if($admin->profile_picture)
                            <img src="{{ asset('storage/' . $admin->profile_picture) }}" alt="Profile Picture" style="width: 50px; height: 50px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $admin->fullname }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editAdminModal{{ $admin->id }}">
                            Edit
                        </button> |
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#deleteAdminModal{{ $admin->id }}">
                            Delete
                        </button>
                        <!-- Edit Admin Modal -->
                        @include('admin.admin_management.modals.admin_edit_modal')
                        <!-- Delete Confirmation Modal -->
                        @include('admin.admin_management.modals.admin_delete_modal')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script>
        @if(session('success'))
            swal("Success", "{{ session('success') }}", "success");
        @endif

        @if($errors->any())
            swal("Error", "{{ $errors->first() }}", "error");
        @endif
    </script>
</body>
</html>
