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
                <a href="{{ route('admin.riasec.page')}}">Riasec Management</a><br>
                <a href="{{ route('admin.course.page') }}">Course Management</a><br>
                <a href="{{ route('admin.logout.request')  }}">Logout</a><br>
            </li>
        </ul>
    </nav>

    <br>
    
    <hr>
    <h1>Riasec List</h1>
        <div class="body">
        <table>
            <thead>
                <tr>
                    <th>Initial</th>
                    <th>Description</th>
                </tr>
            </thead>
            @php
                $riasec_format = ['R', 'I', 'A', 'S', 'E', 'C'];
            @endphp
        
            <tbody>
                @foreach ($riasec_format as $id)
                    @php
                        $riasec_formatting = $riasec->firstWhere('id', $id);
                    @endphp
                    @if ($riasec_formatting)
                        <tr>
                            <td>{{ $riasec_formatting->id }}</td>
                            <td>{{ $riasec_formatting->description }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>