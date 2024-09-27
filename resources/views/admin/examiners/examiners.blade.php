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
                <a href="{{ route('admin.examiners.page')}}">Examiners Management</a><br>
                <a href="{{ route('admin.course.page') }}">Course</a><br>
                <a href="{{ route('admin.logout.request')  }}">Logout</a><br>
            </li>
        </ul>
    </nav>

    <h1>Add default ID</h1>
    <form action="{{ route('admin.add.examiners') }}" method="POST">
        @csrf
        <label for="count">Number of ID to Add</label>
        <input type="number" name="count" min="1" required><br>
        <label for="default_id">Last ID</label>
        <input type="text" name="default_id" readonly value="{{ $next_id }}"><br>
        <input type="submit" value="Add Default ID">
    </form>


</body>
</html>