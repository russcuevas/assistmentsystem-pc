@php
    $css = file_get_contents(public_path('admin/css/print.css'));
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Examinees</title>
    <style>
        {{ $css }}
    </style>
</head>
<body>
    <div id="nav-bar" class="d-flex justify-content-center align-items-center">
        <div>
            <img class="ub-logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('auth/images/ub-logo.png'))) }}" alt="UB Logo" />
        </div>
        <div style="padding:10px;">
            <div id="school-name">
                UNIVERSITY OF BATANGAS LIPA CITY CAMPUS
            </div>
            <div class="sub-details">Sample Address</div>
            <div class="sub-details">www.ub.edu.ph / sample email</div>
            <div class="sub-details">telefax: sample-number</div>
        </div>
    </div>

    <div class="container">
        <h2>List of Examinees</h2>
        @php
            $month = request('month');
            $year = request('year');
        @endphp
        
        @if($month && $year)
            <h4>Filtered for: {{ date('F', mktime(0, 0, 0, $month, 1)) }} {{ $year }}</h4>
        @elseif($month)
            <h4>Filtered for: All years for the month of {{ date('F', mktime(0, 0, 0, $month, 1)) }}</h4>
        @elseif($year)
            <h4>Filtered for: All months for the year of {{ $year }}</h4>
        @else
            <h4>Showing All Examinees</h4>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Birthday</th>
                    <th>Strand</th>
                    <th>Preferred Course</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($examiners as $examiner)
                    @if(!is_null($examiner->fullname) && !empty($examiner->fullname))
                        <tr>
                            <td>{{ $examiner->default_id }}</td>
                            <td>{{ $examiner->fullname }}</td>
                            <td>{{ $examiner->gender }}</td>
                            <td>{{ $examiner->age }}</td>
                            <td>{{ $examiner->birthday }}</td>
                            <td>{{ $examiner->strand }}</td>
                            <td>
                                1.) {{ $examiner->course_1_name ?? 'N/A' }} <br>
                                2.) {{ $examiner->course_2_name ?? 'N/A' }} <br>
                                3.) {{ $examiner->course_3_name ?? 'N/A' }} <br>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td style="text-align: center" colspan="7">No examinees available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>

