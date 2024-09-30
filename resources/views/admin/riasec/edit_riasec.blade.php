<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit RIASEC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        nav {
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 40px;
        }
        .career-pathway {
            margin-bottom: 10px;
        }
        .remove {
            background-color: red;
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
        }
        button {
            margin-top: 10px;
        }
        .alert {
            color: green;
            margin-bottom: 20px;
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

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.update.riasec', $riasec->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h2>Edit RIASEC</h2>
        
        <label for="riasec_id">Initial:</label>
        <input type="text" id="riasec_id" name="riasec_id" required maxlength="1" value="{{ $riasec->id }}" placeholder="R/I/A/S/E/C"><br>

        <label for="riasec_name">RIASEC Name:</label>
        <input type="text" id="riasec_name" name="riasec_name" required value="{{ $riasec->riasec_name }}" placeholder="Enter RIASEC Name"><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required placeholder="Enter description">{{ $riasec->description }}</textarea><br>

        <div id="career-pathway-fields">
            @foreach ($careerPathways as $index => $careerPathway)
                <div class="career-pathway">
                    <label for="career_name[]">Career Pathway:</label>
                    <input type="text" name="career_name[]" required value="{{ $careerPathway->career_name }}" placeholder="Enter career pathway"><br>
                    <label for="course_id[]">Select Courses:</label>
                    <div>
                        @foreach ($courses as $course)
                            <label>
                                <input type="checkbox" name="course_id[{{ $index }}][]" value="{{ $course->id }}" 
                                    {{ in_array($course->id, $careerPathway->courses) ? 'checked' : '' }}>
                                {{ $course->course_name }}
                            </label>
                        @endforeach
                    </div>
                    <button type="button" class="remove">Remove</button>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-career-pathway">Add Another Career Pathway</button><br><br>

        <button type="submit">Update RIASEC</button>
    </form>

    <script>
        let index = {{ count($careerPathways) }};
        document.getElementById('add-career-pathway').addEventListener('click', function() {
            const newField = document.createElement('div');
            newField.className = 'career-pathway';
            newField.innerHTML = `
                <label for="career_name[]">Career Pathway:</label>
                <input type="text" name="career_name[]" required placeholder="Enter career pathway">
                <label for="course_id[]">Select Courses:</label>
                <div>
                    @foreach ($courses as $course)
                        <label>
                            <input type="checkbox" name="course_id[${index}][]" value="{{ $course->id }}">
                            {{ $course->course_name }}
                        </label>
                    @endforeach
                </div>
                <button type="button" class="remove">Remove</button>
            `;
            document.getElementById('career-pathway-fields').appendChild(newField);
            index++;
        });

        document.getElementById('career-pathway-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</body>
</html>
