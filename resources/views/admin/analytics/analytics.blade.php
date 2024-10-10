<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User RIASEC Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
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
                <a href="{{ route('admin.analytics.page')}}">Analytics</a><br>
                <a href="{{ route('admin.logout.request') }}">Logout</a><br>
            </li>
        </ul>
    </nav>

    <h2>Analytics preference based on the response of each examinees</h2>
    <table>
        <thead>
            <tr>
                <th>Fullname</th>
                <th>RIASEC/Scores</th>
                <th>Suggested Courses</th>
                <th>Preferred Courses</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topScores as $userId => $scores)
                <tr>
                    <td>{{ $users[$userId] }}</td>
                    <td>
                        @foreach ($scores as $riasec_id => $data)
                            <div>{{ $riasec_id }} = {{ $data }}</div>
                        @endforeach
                    </td>
                    
                    <td>
                        @foreach ($scores as $riasec_id => $total_points)
                        <div>
                            @if(isset($suggestedCourses[$userId][$riasec_id]))
                                <strong>{{ $riasec_id }}:</strong><br>
                                @foreach ($suggestedCourses[$userId][$riasec_id] as $course)
                                    <?php
                                        $preferredCourseNames = [
                                            $preferredCourses[$userId][$riasec_id]['course_1'] ?? 'N/A',
                                            $preferredCourses[$userId][$riasec_id]['course_2'] ?? 'N/A',
                                            $preferredCourses[$userId][$riasec_id]['course_3'] ?? 'N/A'
                                        ];
                                    ?>
                                    @if (in_array($course->course_name, $preferredCourseNames))
                                        <span style="color: red; font-weight: 900;">→ {{ $course->career_name }}: {{ $course->course_name }}</span><br>
                                    @else
                                        {{ $course->career_name }}: {{ $course->course_name }}<br>
                                    @endif
                                @endforeach
                            @else
                                No suggested courses available for {{ $riasec_id }}.<br>
                            @endif
                        </div>
                        @endforeach
                    </td>
                    <td>
                        <div>
                            @if(isset($preferredCourses[$userId][$riasec_id]))
                                Course 1: {{ $preferredCourses[$userId][$riasec_id]['course_1'] ?? 'N/A' }}<br>
                                Course 2: {{ $preferredCourses[$userId][$riasec_id]['course_2'] ?? 'N/A' }}<br>
                                Course 3: {{ $preferredCourses[$userId][$riasec_id]['course_3'] ?? 'N/A' }}<br>
                            @else
                                No preferred courses available.<br>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    

    <h1>Examiners based on gender</h1>
    <canvas id="gender-chart" width="400" height="100"></canvas>

    <h1>Offered courses</h1>
    <canvas id="course-chart" width="400" height="200"></canvas>

    <h1>Top preferred courses</h1>
    <canvas id="preferred-course-chart" width="400" height="200"></canvas>

    

    {{-- Gender Chart Analytics --}}
    <script>
        fetch('/admin/examiners/data-gender')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.gender);
                const counts = data.map(item => item.count);

                const maleCount = counts[labels.indexOf("Male")] || 0;
                const femaleCount = counts[labels.indexOf("Female")] || 0;

                const ctx = document.getElementById('gender-chart').getContext('2d');

                const genderChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Female', 'Male'],
                        datasets: [{
                            label: 'Total',
                            data: [femaleCount, maleCount],
                            backgroundColor: ['rgba(255, 105, 180, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                            borderColor: ['rgba(255, 105, 180, 1)', 'rgba(75, 192, 192, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>

   {{-- Course Chart Analytics --}}
<script>
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    fetch('/admin/courses/offered')
        .then(response => response.json())
        .then(data => {
            const courseLabels = Object.keys(data.offered_courses);
            const courseCounts = Object.values(data.offered_courses);
            const backgroundColors = courseLabels.map(() => getRandomColor());
            const borderColors = courseLabels.map(() => getRandomColor());

            const ctx = document.getElementById('course-chart').getContext('2d');

            const courseChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: courseLabels,
                    datasets: [{
                        label: 'Offered Courses',
                        data: courseCounts,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label || '';
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching course data:', error);
        });
</script>


{{-- PREFERRED COURSE --}}
<script>
    fetch('/admin/preferred-courses/counts')
        .then(response => response.json())
        .then(data => {
            const courseLabels = Object.keys(data);
            const courseCounts = Object.values(data);

            // Define an array of colors
            const colors = [
                'rgba(255, 99, 132, 0.5)', // Red
                'rgba(54, 162, 235, 0.5)', // Blue
                'rgba(255, 206, 86, 0.5)', // Yellow
                'rgba(75, 192, 192, 0.5)', // Teal
                'rgba(153, 102, 255, 0.5)', // Purple
                'rgba(255, 159, 64, 0.5)', // Orange
                'rgba(255, 99, 71, 0.5)', // Tomato
                'rgba(60, 179, 113, 0.5)', // Medium Sea Green
                'rgba(255, 20, 147, 0.5)', // Deep Pink
                'rgba(255, 165, 0, 0.5)' // Orange
            ];

            // If there are more courses than colors, repeat colors
            const datasetColors = courseLabels.map((_, index) => colors[index % colors.length]);

            const ctx = document.getElementById('preferred-course-chart').getContext('2d');

            const preferredCourseChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: courseLabels,
                    datasets: [{
                        label: 'Number of Students',
                        data: courseCounts,
                        backgroundColor: datasetColors, // Use the unique colors
                        borderColor: datasetColors.map(color => color.replace('0.5', '1')), // Solid color for border
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        r: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching preferred course data:', error);
        });
</script>


</body>
</html>
