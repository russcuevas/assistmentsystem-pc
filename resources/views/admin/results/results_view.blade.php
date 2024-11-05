<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .highlight {
            color: red;
            font-weight: bold;
        }
    </style>
    
</head>
<body>

<h2>{{ $user->fullname }}'s Results</h2>
z
<ul>
    <strong>Fullname:</strong> {{ $user->fullname }}<br>
    <strong>Gender:</strong> {{ $user->gender }}<br>
    <strong>Age:</strong> {{ $user->age }}<br>
    <strong>Birthday:</strong> {{ \Carbon\Carbon::parse($user->birthday)->format('F j, Y') }}<br>
    <strong>Strand:</strong> {{ $user->strand }}<br>
    <strong>Preferred Course:</strong><br> → 
    <span>{!! implode('<br> → ', $preferredCourseNames) !!}</span>
</ul>

<div id="division"></div>

<h2>{{ $user->fullname }}'s INTEREST CODE</h2>

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

<h3>{{ $user->fullname }}'s Top 3 Highest Points in the RIASEC</h3>
<ul>
    @foreach ($top_scores as $riasec_id => $total_points)
        <li>{{ $riasec_id }} ({{ $riasec_names[$riasec_id] ?? 'N/A' }}) = {{ $total_points }}</li>
    @endforeach
</ul>

<h3>{{ $user->fullname }}'s Total Points for Each RIASEC</h3>
<ul>
    @foreach ($riasec_order as $riasec_id)
        <li>{{ $riasec_id }} ({{ $riasec_names[$riasec_id] ?? 'N/A' }}) = {{ $scores->firstWhere('riasec_id', $riasec_id)->total_points ?? 0 }}</li>
    @endforeach
</ul>

<div style="width: 50%; margin-top: 20px;">
    <canvas id="myDonutChart" width="50" height="400"></canvas>  
</div>

<div id="division"></div>

<h2>{{ $user->fullname }}'s Preferred Courses for Top 3 RIASEC <br> <span style="color: brown; font-size: 20px"><i>(the highlighted courses are related to {{ $user->fullname }} preferred courses)</i></span></h2>

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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myDonutChart').getContext('2d');
    var myDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json(array_keys($ordered_scores)),
            datasets: [{
                label: 'RIASEC Scores',
                data: @json(array_values($ordered_scores)),
                backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4caf50', '#ff9f40', '#c45850'],
                hoverOffset: 4
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
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>