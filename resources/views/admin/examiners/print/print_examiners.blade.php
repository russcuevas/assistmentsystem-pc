<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Examinees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.5;
        }

        #nav-bar {
            flex-wrap: wrap;
            background-color: #752738;
            color: #ecf0f1;
            text-align: center;
            -webkit-box-shadow: 0px 5px 5px -5px rgba(107, 102, 107, 0.67);
            -moz-box-shadow: 0px 5px 5px -5px rgba(107, 102, 107, 0.67);
            box-shadow: 0px 5px 5px -5px rgba(107, 102, 107, 0.67);
        }

        #nav-bar .ub-logo {
            width: 105px;
            margin-right: 10px;
            margin-left: 10px;
        }

        #school-name {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .sub-details {
            font-size: 15px;
            font-weight: 400;
            line-height: 25px;
        }

        #nav-body .title {
            margin-top: 20px;
            color: black !important;
            font-size: 30px;
        }

        .container {
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        h4 {
            text-align: left;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        thead {
            display: table-header-group;
        }
        @media print {
            @page {
                margin: 20mm;
            }
            tr {
                page-break-inside: avoid;
            }
            tr:nth-of-type(n+2) th {
                display: none;
            }
        }
    </style>
</head>
<body>

     <div id="nav-bar" class="d-flex justify-content-center align-items-center">
        <div>
        <img class="ub-logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('auth/images/ub-logo.png'))) }}" alt="UB Logo" />
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
