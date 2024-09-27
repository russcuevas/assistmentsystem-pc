<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Examination Form</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .radio-label {
            display: block;
        }
    </style>
</head>
<body>

    <h1>Welcome {{ $user->fullname }}, {{ $user->default_id }}</h1>

    <a href="{{ route('users.logout.request') }}">Logout</a><br>
    <form action="{{ route('users.submit.responses') }}" method="POST">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>True</th>
                    <th>False</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->question_text }}</td>
                    <td>
                        @if (in_array($question->riasec_id, ['R', 'I', 'A', 'S', 'E', 'C']))
                            <label class="radio-label">
                                <input type="radio" name="answer[{{ $question->id }}]" value="true"> True
                            </label>
                        @endif
                    </td>
                    <td>
                        @if (in_array($question->riasec_id, ['R', 'I', 'A', 'S', 'E', 'C']))
                            <label class="radio-label">
                                <input type="radio" name="answer[{{ $question->id }}]" value="false"> False
                            </label>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
