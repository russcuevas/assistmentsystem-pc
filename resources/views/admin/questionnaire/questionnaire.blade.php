<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        .checked {
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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
                <a href="{{ route('admin.logout.request') }}">Logout</a><br>
            </li>
        </ul>
    </nav>
    <hr>
    <h1>Questionnaire Page</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.add.questionnaire') }}" method="POST">
        @csrf
        <input type="hidden" name="is_correct" value="1">
        <input type="hidden" name="option_text" id="option_text" required readonly>

        <label for="question_text">Question</label>
        <input type="text" name="question_text" required> <br>
    
        @php
        $riasec_format = ['R', 'I', 'A', 'S', 'E', 'C'];
        @endphp
        <label for="riasec_id">Select Riasec</label>
        <select name="riasec_id" id="riasec_id" required>
            @foreach ($riasec_format as $format)
                @php
                    $riasec = $riasecs->firstWhere('id', $format);
                @endphp
                @if ($riasec)
                    <option value="{{ $riasec->id }}">{{ $riasec->id }}</option>
                @endif
            @endforeach
        </select><br>

        <input type="submit" value="Add Question">
    </form>

    <!-- Questionnaire Table -->
    <h2>Questionnaire Questions</h2>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Related</th>
                <th>Options</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->question_text }}</td>
                    <td>{{ $question->riasec_id }} = {{ $question->riasec_name }}</td>
                    <td>
                        <ul>
                            @foreach ($options as $option)
                                @if ($option->question_id == $question->id)
                                    <li>{{ $option->option_text }} (Correct: {{ $option->is_correct ? 'Yes' : 'No' }})</li>
                                @endif
                            @endforeach
                        </ul>
                    </td>                   
                    <td>
                        <a href="{{ route('admin.edit.questionnaire', $question->id) }}">Update</a> 
                        <form action="{{ route('admin.delete.questionnaire', $question->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="submit" value="Delete" onclick="return confirm('Are you sure?');">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        this.nextElementSibling.classList.add('checked');
                    } else {
                        this.nextElementSibling.classList.remove('checked');
                    }
                });
            });
        });

        const riasecSelect = document.getElementById('riasec_id');
        const optionInput = document.getElementById('option_text');

        riasecSelect.addEventListener('change', function() {
            optionInput.value = this.options[this.selectedIndex].text;
        });

        optionInput.value = riasecSelect.options[riasecSelect.selectedIndex].text;
    </script>
</body>
</html>
