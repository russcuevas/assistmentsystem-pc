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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{ asset('admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="{{ asset('admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    <!-- Morris Chart Css-->
    <link href="{{ asset('admin/plugins/morrisjs/morris.css') }}" rel="stylesheet" />\
    <link href="{{ asset('admin/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <!-- Custom Css -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/themes/all-themes.css') }}" rel="stylesheet" />
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
             
            <div class="row clearfix">
                <!-- Bar Chart -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 25px; font-weight: 900; color: #752738;">
                                Yearly Examinees
                            </h2>
                        </div>
                        <div class="body">
                            <canvas id="yearlyExaminees" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
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
    <script src="{{ asset('admin/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('admin/js/pages/forms/form-validation.js') }}"></script>
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script src="{{ asset('admin/js/pages/index.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/dashboard_analytics/dashboard_chart.js')}}"></script>
    <script src="{{ asset('admin/js/ajax/change_password/change_password.js')}}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('admin/js/demo.js') }}"></script>
</body>

</html>