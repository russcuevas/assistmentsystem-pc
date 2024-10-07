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
    <link href="{{ asset('admin/css/themes/all-themes.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/HoldOn.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* TABLE HEADER */
        th {
            font-weight: 900;
            color: rgba(0, 0, 0, 0.805);
        }

        /* ACTIONS BUTTON */
        .fa-solid.fa-pen-to-square {
            color: #752738;
            font-size: 24px;
        }

        .fa-solid.fa-pen-to-square:hover {
            color: #a94442;
        }

        .fa-solid.fa-trash {
            font-size: 20px !important;
        }

        /* DATA TABLE BUTTON */
        .custom-button {
            background-color: #752738 !important;
            color: #fff !important;
            border: none !important;
        }

        .custom-button:hover {
            background-color: #a12a38 !important;
        }

        .loading-message {
            font-family: 'Arial', sans-serif;
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
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a id="app-title" style="display:flex;align-items:center" class="navbar-brand" href="{{ route('admin.dashboard.page') }}">
                    <img id="bcas-logo" style="width:45px;display:inline;margin-right:10px;"  src="{{ asset('admin/images/ub-logo.png') }}" />
                    <span style="color: #FEC653;">ASSISTments</span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="pull-right">
                        <a href="javascript:void(0);" class="js-right-sidebar" data-close="true">
                            <i class="material-icons">account_circle</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                    <li class="active"><i style="font-size: 20px;" class="material-icons">badge</i> List
                        of Default ID
                    </li>
                </ol>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 25px; font-weight: 900; color: #752738;">
                                List of Default ID
                            </h2>
                        </div>
                        <div class="body">
                            <div>
                                <a href="" class="btn bg-red waves-effect" style="margin-bottom: 15px;" data-toggle="modal" data-target="#addDefaultIdModal">+ ADD DEFAULT ID</a>
                            </div>
                            @include('admin.default_id.modals.add_default_id')
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="text-align: left;">
                                                    <h3>No records</h3>
                                                </td>
                                                <td style="text-align: right;">
                                                <button id="delete-selected-default-id-btn" 
                                                        class="btn bg-red waves-effect btn-sm" 
                                                        style="display: none;" 
                                                        data-route="{{ route('admin.default.id.bulk.delete') }}">
                                                    DELETE SELECTED
                                                </button>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Default ID</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($available_default_id as $default_id)
                                                    @if (empty($default_id->fullname))
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" class="delete-checkbox" id="checkbox-{{ $default_id->default_id }}" value="{{ $default_id->default_id }}">
                                                                <label for="checkbox-{{ $default_id->default_id }}">{{ $default_id->default_id }}</label>
                                                            </td>
                                                            <td>
                                                                <button class="btn bg-red waves-effect btn-sm" 
                                                                        data-toggle="modal" 
                                                                        data-target="#deleteExaminersModal{{ $default_id->default_id }}">
                                                                    DELETE
                                                                </button>
                                                                @include('admin.default_id.modals.delete_default_id')
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr>
                                                        <td colspan="2" class="text-center">No records</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Has records</h3>
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Default ID</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($available_default_id as $default_id)
                                                    @if (!empty($default_id->fullname))
                                                        <tr>
                                                            <td>{{ $default_id->default_id }}</td>
                                                            <td><span>Has records</span></td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr>
                                                        <td colspan="2" class="text-center">No records</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
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

    {{-- SWEETALERT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom Js -->
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script src="{{ asset('admin/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('admin/js/HoldOn.js') }}"></script>

    {{-- AJAX REQUEST --}}
    <script src="{{ asset('admin/js/ajax/default_id/add_default_id.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/default_id/delete_default_id.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/default_id/delete_bulk_default_id.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('admin/js/demo.js') }}"></script>
</body>

</html>