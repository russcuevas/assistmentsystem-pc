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
                <a href="{{ route('admin.analytics.page')}}">Analytics</a>
                <a href="{{ route('admin.logout.request') }}">Logout</a><br>
            </li>
        </ul>
    </nav>

    <h1>Add admin</h1>
    <form action="{{ route('admin.add.admin') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="">Profile picture</label><br>
        <input type="file" name="profile_picture"><br>
        <label for="">Fullname</label><br>
        <input type="text" name="fullname"><br>
        <label for="">Email</label><br>
        <input type="email" name="email"><br>
        <label for="">Password</label><br>
        <input type="password" name="password"><br>
        <input type="submit" value="Add admin">
    </form>
    <br>
    <hr>
    <h1>Admin List</h1>
        <div class="body">
        <table>
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
                            <a href="{{ route('admin.edit.admin', $admin->id) }}">Edit</a> |
                            <form action="{{ route('admin.delete.admin', $admin->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

        </table>
    </div>
</body>
</html>