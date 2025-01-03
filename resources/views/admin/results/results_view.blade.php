<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UB - Assistments</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('admin/images/ub-logo.png') }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{ asset('admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="{{ asset('admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <!-- Custom Css -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/themes/all-themes.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/HoldOn.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #nav-bar {
            flex-wrap: wrap;
            background-color: #752738;
            color: #ecf0f1;
            text-align: left;
            -webkit-box-shadow: 0px 5px 5px -5px rgba(107, 102, 107, 0.67);
            -moz-box-shadow: 0px 5px 5px -5px rgba(107, 102, 107, 0.67);
            box-shadow: 0px 5px 5px -5px rgba(107, 102, 107, 0.67);
        }
        #nav-bar .ub-logo {
            width: 105px;
            margin-right: 10px;
            margin-left: 10px;
        }

        #division {
            border: 0;
            border-bottom: 3px solid #752738;
            width: 100%;
            margin-top: 10px;
        }

        .container-box {
            width: 100%;
            max-width: 100%;
            padding-left: 50px;
            padding-right: 50px;
            margin-top: 30px;
            margin-bottom: 30px;
            background-color: white;
            border: #ccc solid 1px;
        }
        .highlight {
            color: red;
            font-weight: bold;
        }
    </style>
    
</head>
    <body>

    <div id="nav-bar" class="d-flex justify-content-center align-items-center">
        <div>
            <img class="ub-logo" style="border-radius: 50px; height: 80px; width: 80px;" src="{{ asset('auth/images/ub-logo.png') }}" alt="UB Logo" /> 
            <img class="ub-logo" style="border-radius: 50px; height: 70px; width: 70px; margin-left: -10px;" src="{{ asset('examinees/images/copwell-logo.jpg') }}" />
        </div>
    </div>

    <div class="container">
        <div class="container-box">
            <a class="btn btn-danger me-2" style="float: right; margin-top: 30px;" href="{{ route('admin.results.page')  }}">Go back</a>
            <h2>RIASEC RESULT</h2>

            <ul>
                <strong>Fullname:</strong> {{ $user->fullname }}<br>
                <strong>Sex:</strong> <span style="text-transform: capitalize">{{ $user->gender }}</span><br>
                <strong>Age:</strong> {{ $user->age }}<br>
                <strong>Birthday:</strong> {{ \Carbon\Carbon::parse($user->birthday)->format('F j, Y') }}<br>
                <strong>Strand:</strong> {{ $user->strand }}<br>
                <strong>Preferred Course:</strong><br> → 
                <span>{!! implode('<br> → ', $preferredCourseNames) !!}</span>
            </ul>

            <div id="division"></div>

            <h2>INTEREST CODE</h2>

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

            <div class="row">
                <div class="col-md-6">
                    <h3>Top 3 Highest Points in the RIASEC</h3>
                    <ul>
                        @foreach ($top_scores as $riasec_id => $total_points)
                            <li>{{ $riasec_id }} ({{ $riasec_names[$riasec_id] ?? 'N/A' }}) = {{ $total_points }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-6">
                    <h3>Total Points for Each RIASEC</h3>
                    <ul>
                        @foreach ($riasec_order as $riasec_id)
                            <li>{{ $riasec_id }} ({{ $riasec_names[$riasec_id] ?? 'N/A' }}) = {{ $scores->firstWhere('riasec_id', $riasec_id)->total_points ?? 0 }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>


            <div style="width: 100%; height: 100vh; display: flex !important; justify-content: center !important; align-items: center !important;">
                <canvas id="myDonutChart" width="50" height="400"></canvas>  
            </div>


            <div id="division"></div>

            <h2>Suggested Courses for Top 3 RIASEC <br> <span style="color: brown; font-size: 20px;"><i>(the highlighted courses are related to {{ $user->fullname }} preferred courses)</i></span><br><br></h2>
            <h6 style="color: brown; font-weight: 900;">SUGGESTED COURSE</h6>
            <ul style="margin-bottom: 50px !important;">
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
<!-- Jquery Core Js -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

    {{-- PDF WORKER --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>


    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>

    {{-- SWEETALERT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Custom Js -->
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script src="{{ asset('admin/js/HoldOn.js') }}"></script>
    <script src="{{ asset('admin/js/pages/tables/jquery-datatable.js') }}"></script>

    {{-- AJAX REQUEST --}}
    <script src="{{ asset('admin/js/ajax/change_password/change_password.js')}}"></script>

    





    <script src="{{ asset('admin/js/demo.js') }}"></script>
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