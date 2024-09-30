<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Completed</title>
    <style>
    .highlight {
        font-weight: bold;
        color: red;
    }
    </style>
</head>
<body>
    <a href="{{ route('users.logout.request') }}">Logout</a>
    <h1>MY INTEREST CODE</h1>

    <h2>Top 3 Highest Points in the RIASEC</h2>
    <ul>
        @foreach ($scores as $score)
            <li>{{ $score->riasec_id }} = {{ $score->total_points }}</li>
        @endforeach
    </ul>

    <h2>Total Points for Each Interest Code</h2>
    <ul>
        <li>R = Realistic: {{ $all_scores['R'] ?? 0 }}</li>
        <li>I = Investigative: {{ $all_scores['I'] ?? 0 }}</li>
        <li>A = Artistic: {{ $all_scores['A'] ?? 0 }}</li>
        <li>S = Social: {{ $all_scores['S'] ?? 0 }}</li>
        <li>E = Enterprising: {{ $all_scores['E'] ?? 0 }}</li>
        <li>C = Conventional: {{ $all_scores['C'] ?? 0 }}</li>
    </ul>

<h2>Preferred Courses for Top 3 RIASEC <span style="color: brown"><i>(the highlighted related to your preferred course)</i></span></h2>
<ul>
    @foreach ($scores as $score)
        @if (isset($groupedPreferredCourses[$score->riasec_id]))
            <li>
                @php
                    $firstCareer = array_key_first($groupedPreferredCourses[$score->riasec_id]);
                    $riasecName = $groupedPreferredCourses[$score->riasec_id][$firstCareer][0]['riasec_name'] ?? '';
                @endphp
                {{ $riasecName }}//
                @foreach ($groupedPreferredCourses[$score->riasec_id] as $careerName => $courses)
                    <br>{{ $careerName }}: 
                    @foreach ($courses as $course)
                        <span class="{{ in_array($course['id'], $preferredCourseIds) ? 'highlight' : '' }}">
                            {{ $course['name'] }}, &nbsp;
                        </span>
                    @endforeach
                @endforeach
            </li>
        @endif
    @endforeach
</ul>






    <canvas id="myDonutChart" width="50" height="400"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myDonutChart').getContext('2d');
        const data = {
            labels: ['Realistic', 'Investigative', 'Artistic', 'Social', 'Enterprising', 'Conventional'],
            datasets: [{
                label: 'Points',
                data: [
                    {{ $all_scores['R'] ?? 0 }},
                    {{ $all_scores['I'] ?? 0 }},
                    {{ $all_scores['A'] ?? 0 }},
                    {{ $all_scores['S'] ?? 0 }},
                    {{ $all_scores['E'] ?? 0 }},
                    {{ $all_scores['C'] ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'RIASEC Interest Scores'
                    }
                }
            },
        };

        const myDonutChart = new Chart(ctx, config);
    </script>
</body>
</html>
