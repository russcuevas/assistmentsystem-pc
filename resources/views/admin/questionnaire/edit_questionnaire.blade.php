<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question</title>
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

    <h1>Edit Question</h1>

    <form action="{{ route('admin.update.questionnaire', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="is_correct" value="1">
        <input type="hidden" name="option_text" id="option_text" required value="{{ $options->first()->option_text }}"> <br>

        <label for="question_text">Question</label>
        <input type="text" name="question_text" value="{{ $question->question_text }}" required> <br>

        <label for="riasec_id">Select Riasec</label>
        <select name="riasec_id" id="riasec_id" onchange="updateOptionText(this.value)" required>
            @foreach ($riasecs as $riasec)
                <option value="{{ $riasec->id }}" {{ $riasec->id == $question->riasec_id ? 'selected' : '' }}>
                    {{ $riasec->id }}
                </option>
            @endforeach
        </select><br>
    
        <input type="submit" value="Update Question">
    </form>

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
