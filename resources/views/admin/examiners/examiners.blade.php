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
    .select-form {
        display: block !important;
        width: 100% !important;
        height: 34px !important;
        padding: 6px 12px !important;
        font-size: 14px !important;
        line-height: 1.42857143 !important;
        color: #555 !important;
        background-color: #fff !important;
        background-image: none !important;
        border: 1px solid #ccc !important;
        border-radius: 4px !important;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075) !important;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075) !important;
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s !important;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s !important;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s !important;
    }

    @media only screen and (max-width: 600px) {
        .btn {
            font-size: 9px !important;
            height: 27px;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }


        .btn .material-icons {
            font-size: 14px !important;
            top: 2px;
        }

        .filter-button {
            margin: 0 auto 20px;
            height: 34px;
            display: block;
        }

        
    }

    @media (min-width: 992px) {

        .select-form-lg {
            margin-left: -20px !important;
        }
        .filter-button {
            margin: 0 auto 20px;
            height: 33px;
            margin-left: -40px !important;
        }
    }
    .table-responsive {
        border: none !important;
    }
</style>
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
                <ol style="font-size: 15px;" class="breadcrumb breadcrumb-col-red">
                    <li><a href="dashboard.html"><i style="font-size: 20px;" class="material-icons">home</i>
                            Dashboard</a></li>
                    <li class="active"><i style="font-size: 20px;" class="material-icons">groups</i> 
                        Examinees Management
                    </li>
                    <li class="active"><i style="font-size: 20px;" class="material-icons">badge</i> 
                        Examinees List
                    </li>
                </ol>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                            <h2 class="m-0" style="font-size: 25px; font-weight: 900; color: #752738;">
                                List of Examinees
                            </h2>
                            <div id="print-container">
                                @if($examiners->isNotEmpty() && $examiners->whereNotNull('fullname')->isNotEmpty())
                                    <form id="printExamineesForm" style="display:inline;" data-route-print="{{ route('admin.print-examinees') }}">
                                        <input type="hidden" name="month" value="{{ request('month') }}">
                                        <input type="hidden" name="year" value="{{ request('year') }}">
                                        <button type="submit" class="btn bg-red waves-effect btn-sm">
                                            <i class="material-icons">print</i>
                                            <span>Download for Print</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="row mb-3">
                            <div class="form-group">
                                <form action="{{ route('admin.filter-month-year.examiners') }}" method="GET">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                                            <select class="form-control select-form" id="month" name="month">
                                                <option value="">All months</option>
                                                @foreach (range(1, 12) as $monthValue)
                                                    <option value="{{ $monthValue }}" {{ $monthValue == request('month') ? 'selected' : '' }}>
                                                        {{ date('F', mktime(0, 0, 0, $monthValue, 1)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                                            <select class="form-control select-form select-form-lg" id="year" name="year">
                                                <option value="">All years</option>
                                                @foreach (range(date('Y'), date('Y') + 2) as $yearValue)
                                                    <option value="{{ $yearValue }}" {{ $yearValue == request('year') ? 'selected' : '' }}>
                                                        {{ $yearValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                            <button type="submit" class="btn bg-red waves-effect btn-sm filter-button">
                                                <i class="material-icons">filter_list</i> <span class="filter-span">FILTER</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div id="printable-area" class="table-responsive mt-3">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fullname</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Birthday</th>
                                        <th>Strand</th>
                                        <th>Preferred Course</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
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
                                                <td>{{ $examiner->created_at }}</td>
                                                <td>{{ $examiner->updated_at }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i style="font-size: 15px" class="material-icons">more_vert</i>
                                                        </button>
                                                        <ul class="dropdown-menu" style="z-index: 9999; position: relative;">
                                                            <li>
                                                                <a href="javascript:void(0);" 
                                                                data-toggle="modal"
                                                                data-target="#viewExaminersModal{{ $examiner->id }}">
                                                                    VIEW
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);"                 
                                                                data-toggle="modal" 
                                                                data-target="#deleteExamineesModal{{ $examiner->id }}">
                                                                    DELETE
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    {{-- VIEW EXAMINEES MODAL --}}
                                                    @include('admin.examiners.modals.view_examinees')
                                                    {{-- DELETE EXAMINEES MODAL --}}
                                                    @include('admin.examiners.modals.delete_examinees')
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td style="text-align: center" colspan="10">No examinees available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

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
    <script src="{{ asset('admin/js/ajax/examiners/delete_examiners.js')}}"></script>
    <script src="{{ asset('admin/js/ajax/examiners/print_examiners.js')}}"></script>

    






    <script src="{{ asset('admin/js/demo.js') }}"></script>
</body>

</html>