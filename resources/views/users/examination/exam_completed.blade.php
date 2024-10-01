<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('auth/images/ub-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('examinees/css/completed_style.css') }}">
    <title>UB - Assistments</title>
    <style>
        .highlight {
            font-weight: bold;
            color: red;
        }
        h1, h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <div id="nav-bar" class="d-flex justify-content-center align-items-center">
        <div>
            <img class="ub-logo" src="{{ asset('auth/images/ub-logo.png') }}" alt="UB Logo" />
        </div>
        <div style="padding:10px;">
            <div>
                <div id="school-name">
                    UNIVERSITY OF BATANGAS LIPA CITY CAMPUS
                </div>
                <div class="sub-details">
                    Sample Address
                </div>
                <div class="sub-details">
                    www.ub.edu.ph / sample email
                </div>
                <div class="sub-details">
                    telefax: sample-number
                </div>
            </div>
        </div>
    </div>

    <div id="nav-body" class="d-flex justify-content-center" style="margin-bottom:50px;">
        <div id="form-container">
            <div class="title">
                <div style="display:flex;align-items:center">
                    <div>
                        <img src="{{ asset('auth/images/ub-logo.png') }}" />
                    </div>
                    <div>
                        UB RIASEC RESULTS
                    </div>
                </div>
            </div>

            <div id="division"></div>
            <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
                <h2>Personal Details</h2>
                <div>
                    <a href="" class="btn btn-secondary me-2">Profile</a>
                    <a href="{{ route('users.logout.request') }}" class="btn btn-danger">Logout</a>
                </div>
            </div>
            
            <ul>
                <strong>Fullname:</strong> {{ $user->fullname }}<br>
                <strong>Gender:</strong> {{ $user->gender }}<br>
                <strong>Age:</strong> {{ $user->age }}<br>
                <strong>Birthday:</strong> {{ \Carbon\Carbon::parse($user->birthday)->format('F j, Y') }}<br>
                <strong>Strand:</strong> {{ $user->strand }}<br>
                <strong>Preferred Course</strong><br> →
                    <span>{!! implode('<br> → ', $preferredCourseNames) !!}</span>
            </ul>
            
            <div id="division"></div>
            <h2 class="mt-3">MY INTEREST CODE</h2>
            
            @php
            $riasec_names = DB::table('riasecs')->pluck('riasec_name', 'id')->toArray();
            $riasec_order = ['R', 'I', 'A', 'S', 'E', 'C'];
            $ordered_scores = [];
            
            foreach ($riasec_order as $riasec_id) {
                $total_points = $scores->firstWhere('riasec_id', $riasec_id)->total_points ?? 0;
                if ($total_points > 0) {
                    $ordered_scores[$riasec_id] = $total_points;
                }
            }
            
            arsort($ordered_scores);
            $top_scores = array_slice($ordered_scores, 0, 3, true);
            @endphp
            
            <h2>Top 3 Highest Points in the RIASEC</h2>
            <ul>
                @foreach ($top_scores as $riasec_id => $total_points)
                    <li>{{ $riasec_id }} ({{ $riasec_names[$riasec_id] ?? 'N/A' }}) = {{ $total_points }}</li>
                @endforeach
            </ul>
            
            <h2>Total Points for Each RIASEC</h2>
            <ul>
                @foreach ($riasec_order as $riasec_id)
                    <li>{{ $riasec_id }} ({{ $riasec_names[$riasec_id] ?? 'N/A' }}) = {{ $all_scores[$riasec_id] ?? 0 }}</li>
                @endforeach
            </ul>

            <div style="width: 50%">
                <canvas id="myDonutChart" width="50" height="400"></canvas>  
            </div>
            <br>
            <h2>Preferred Courses for Top 3 RIASEC <br> <span style="color: brown; font-size: 20px"><i>(the highlighted related to your preferred course)</i></span></h2>
            <ul>
                @foreach ($scores as $score)
                    @if (isset($groupedPreferredCourses[$score->riasec_id]))
                        <li>
                            @php
                                $firstCareer = array_key_first($groupedPreferredCourses[$score->riasec_id]);
                                $riasecName = $groupedPreferredCourses[$score->riasec_id][$firstCareer][0]['riasec_name'] ?? '';
                            @endphp
                            <span style="font-weight: 900">{{ $riasecName }}</span>
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
        
        </div>
    </div>
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
