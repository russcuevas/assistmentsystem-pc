<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UB - Assistments</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('admin/images/ub-logo.png') }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{ asset('admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="{{ asset('admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">
    <!-- Morris Chart Css-->
    <link href="{{ asset('admin/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/themes/all-themes.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/HoldOn.css') }}">
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    @include('admin.components.top_bar')
    <!-- #Top Bar -->

    <section>
        <!-- Left Sidebar -->
        @include('admin.components.left_sidebar')
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        @include('admin.components.right_sidebar')
        <!-- #END# Right Sidebar -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2 style="font-size: 25px; font-weight: 900; color: #752738 !important;">DATA ANALYTICS</h2>
            </div>
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">admin_panel_settings</i>
                        </div>
                        <div class="content">
                            <div class="text" style="color: #FEC653 !important;">TOTAL ADMIN</div>
                            <div class="" style="font-size: 20px;">{{ $get_total_admin }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">groups</i>
                        </div>
                        <div class="content">
                            <div class="text" style="color: #FEC653 !important;">TOTAL EXAMINEES</div>
                            <div class="" style="font-size: 20px;">{{ $get_total_examinees }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">done_all</i>
                        </div>
                        <div class="content">
                            <div class="text" style="color: #FEC653 !important;">TOTAL COURSE</div>
                            <div class="" style="font-size: 20px;">{{ $get_total_course }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <!-- Bar Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                YEARLY EXAMINEES
                            </h2>
                        </div>
                        <div class="body">
                            <canvas id="yearlyExaminees" height="139"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                EXAMINERS BASED ON SEX
                            </h2>
                        </div>
                        <div class="body">
                            <form action="">
                                <div class="form-group" style="display: flex; align-items: center;">
                                    <label for="year-select-gender"
                                        style="font-weight: 600; margin-right: 10px;">Year:</label>
                                    <div class="form-line" style="width: 100px">
                                        <select class="form-control show-tick" id="year-select-gender"
                                            style="border: none; box-shadow: none;">
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                        </select>
                                    </div>
                                </div>
                                <canvas id="gender-chart" height="105"></canvas>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
            </div>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                OFFERED COURSE
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Course Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($course as $index => $available_course)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $available_course->course_name }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                TOP PREFERRED COURSE
                            </h2>
                        </div>
                        <div class="body">
                            <canvas id="preferred-course-chart" height="248"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                RIASEC BASED USER SCORES ANALYTICS
                            </h2>
                        </div>
                        <div class="body">
                            <form action="">
                                <div class="form-group" style="display: flex; align-items: center;">
                                    <label for="year-select-riasec"
                                        style="font-weight: 600; margin-right: 10px;">Year:</label>
                                    <div class="form-line" style="width: 100px">
                                        <select class="form-control show-tick" id="year-select-riasec"
                                            style="border: none; box-shadow: none;">
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="riasec-chart" style="height: 400px;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                ANALYTICS PREFERENCE BASED ON RESULTS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Fullname</th>
                                                    <th>RIASEC/Scores</th>
                                                    <th>Suggested Courses</th>
                                                    <th>Preferred Courses</th>
                                                    <th>Date Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($topScores as $userId => $scores)
                                                <tr>
                                                    <td>{{ $users[$userId] }}</td>
                                                    <td>
                                                        @foreach ($scores as $riasec_id => $data)
                                                            <div>
                                                                @switch($riasec_id)
                                                                    @case('R')
                                                                        Realistic
                                                                        @break
                                                                    @case('I')
                                                                        Investigative
                                                                        @break
                                                                    @case('A')
                                                                        Artistic
                                                                        @break
                                                                    @case('S')
                                                                        Social
                                                                        @break
                                                                    @case('E')
                                                                        Enterprising
                                                                        @break
                                                                    @case('C')
                                                                        Conventional
                                                                        @break
                                                                    @default
                                                                        Unknown
                                                                @endswitch
                                                                = {{ $data }}
                                                            </div>
                                                        @endforeach
                                                    </td>
            
                                                    <td>
                                                        @foreach ($scores as $riasec_id => $total_points)
                                                        <div>
                                                            @if(isset($suggestedCourses[$userId][$riasec_id]))
                                                            <strong>
                                                                @switch($riasec_id)
                                                                    @case('R')
                                                                        Realistic:
                                                                        @break
                                                                    @case('I')
                                                                        Investigative:
                                                                        @break
                                                                    @case('A')
                                                                        Artistic:
                                                                        @break
                                                                    @case('S')
                                                                        Social:
                                                                        @break
                                                                    @case('E')
                                                                        Enterprising:
                                                                        @break
                                                                    @case('C')
                                                                        Conventional:
                                                                        @break
                                                                    @default
                                                                        Unknown
                                                                @endswitch
                                                            </strong><br>
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
                                                                No suggested courses available for 
                                                                @switch($riasec_id)
                                                                    @case('R')
                                                                        Realistic
                                                                        @break
                                                                    @case('I')
                                                                        Investigative
                                                                        @break
                                                                    @case('A')
                                                                        Artistic
                                                                        @break
                                                                    @case('S')
                                                                        Social
                                                                        @break
                                                                    @case('E')
                                                                        Enterprising
                                                                        @break
                                                                    @case('C')
                                                                        Conventional
                                                                        @break
                                                                    @default
                                                                        Unknown
                                                                @endswitch.
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                    </td>
            
                                                    <td>
                                                        <div>
                                                            @if(isset($preferredCourses[$userId][$riasec_id]))
                                                            1: {{ $preferredCourses[$userId][$riasec_id]['course_1'] ?? 'N/A' }}<br>
                                                            2: {{ $preferredCourses[$userId][$riasec_id]['course_2'] ?? 'N/A' }}<br>
                                                            3: {{ $preferredCourses[$userId][$riasec_id]['course_3'] ?? 'N/A' }}<br>
                                                            @else
                                                                No preferred courses available.<br>
                                                            @endif
                                                        </div>
                                                    </td>
            
                                                    <td>
                                                        <div>
                                                            @if(isset($scoreDates[$userId]) && count($scoreDates[$userId]) > 0)
                                                            {{
                                                                \Carbon\Carbon::parse(array_values($scoreDates[$userId])[0])->format('Y-m-d H:i')
                                                            }}
                                                            @else
                                                            No date available.<br>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
        </div>
    </section>


    <!-- Jquery Core Js -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('admin/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('admin/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('admin/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('admin/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('admin/plugins/flot-charts/jquery.flot.time.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

    {{-- SWEETALERT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom Js -->
    <script>
        $(function () {
        $('.js-basic-example').DataTable({
            responsive: true,
            pageLength: 5,
            lengthChange: false
        });

        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            pageLength: 5,
            lengthChange: false,
            buttons: [
                { extend: 'copy', className: 'custom-button' },
                { extend: 'csv', className: 'custom-button' },
                { extend: 'excel', className: 'custom-button' },
                { extend: 'pdf', className: 'custom-button' },
                { extend: 'print', className: 'custom-button' }
            ]
        });
    });
    </script>
    <script src="{{ asset('admin/js/pages/forms/form-validation.js') }}"></script>
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script src="{{ asset('admin/js/HoldOn.js') }}"></script>
    <script src="{{ asset('admin/js/pages/index.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/dashboard_analytics/dashboard_chart.js')}}"></script>
    <script src="{{ asset('admin/js/ajax/change_password/change_password.js')}}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('admin/js/demo.js') }}"></script>
</body>

</html>