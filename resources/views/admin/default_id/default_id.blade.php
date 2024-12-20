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
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">
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
                        Add Examiners
                    </li>
                </ol>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 25px; font-weight: 900; color: #752738;">
                                Add Examiners
                            </h2>
                        </div>
                        <div class="body">
                            <div>
                                <a href="" class="btn bg-red waves-effect" style="margin-bottom: 15px;" data-toggle="modal" data-target="#addDefaultIdModal">+ ADD EXAMINERS</a>
                            </div>
                            @include('admin.default_id.modals.add_default_id')
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Examiner ID</th>
                                                    <th>Fullname</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($available_default_id as $default_id)
                                                    @if (!empty($default_id->fullname))
                                                        <tr>
                                                            <td>{{ $default_id->default_id }}</td>
                                                            <td>{{ $default_id->fullname }}</td>
                                                            <td>{{ $default_id->created_at }}</td>
                                                            <td>{{ $default_id->updated_at }}</td>
                                                            <td>
                                                                <a href="#" data-toggle="modal" data-target="#viewExaminersDetails{{ $default_id->id }}" class="btn btn-warning">View Information</a>
                                                                        {{-- VIEW MODAL --}}
 
                                                                        @foreach ($available_default_id as $default_id)
                                                                        <div class="modal fade" id="viewExaminersDetails{{ $default_id->id }}" tabindex="-1" role="dialog" aria-labelledby="viewExaminersDetailsLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-md" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="viewExaminersDetailsLabel">Examiners Information</h4>
                                                                                        <hr style="background-color: #752738; height: 2px; border: none;">
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                                <p><strong>Examiner ID:</strong> {{ $default_id->default_id }}</p>
                                                                                                <p><strong>Fullname:</strong> {{ $default_id->fullname }}</p>
                                                                                                <p><strong>Sex:</strong> <span style="text-transform: capitalize">{{ $default_id->gender }}</span></p>
                                                                                                <p><strong>Age:</strong> {{ $default_id->age }}</p>
                                                                                                <p><strong>Birthday:</strong> {{ $default_id->birthday }}</p>
                                                                                                <p><strong>Strand:</strong> {{ $default_id->strand }}</p>
                                                                                                <p><strong>Email:</strong> {{ $default_id->email }}</p>
                                                                                                <p><strong>Created At:</strong> {{ $default_id->created_at }}</p>
                                                                                                <p><strong>Updated At:</strong> {{ $default_id->updated_at }}</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button class="btn bg-red waves-effect">PRINT INFORMATION</button>
                                                                                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">No records</td>
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
    <script src="{{ asset('admin/js/pages/forms/form-validation.js') }}"></script>
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script src="{{ asset('admin/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('admin/js/HoldOn.js') }}"></script>

    {{-- AJAX REQUEST --}}
    <script src="{{ asset('admin/js/ajax/change_password/change_password.js')}}"></script>
    <script src="{{ asset('admin/js/ajax/default_id/add_default_id.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/default_id/delete_default_id.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/default_id/delete_bulk_default_id.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('admin/js/demo.js') }}"></script>
</body>

</html>