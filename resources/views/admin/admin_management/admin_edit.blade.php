<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Admin</title>
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
                <a href="{{ route('admin.logout.request') }}">Logout</a><br>
            </li>
        </ul>
    </nav>

    <h1>Edit Admin</h1>
    <form action="{{ route('admin.update.admin', $admin->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="">Profile Picture</label><br>
        <input type="file" name="profile_picture"><br>
        <label for="">Fullname</label><br>
        <input type="text" name="fullname" value="{{ old('fullname', $admin->fullname) }}"><br>
        <label for="">Email</label><br>
        <input type="email" name="email" value="{{ old('email', $admin->email) }}"><br>
        <label for="">Password (leave blank to keep current)</label><br>
        <input type="password" name="password"><br>
        <input type="submit" value="Update Admin">
    </form>
</body>
</html>
