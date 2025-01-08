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
        .fields-scroll {
            max-height: 150px;
            overflow-y: auto;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            padding: 10px;
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
                    <li class="active"><i style="font-size: 20px;" class="material-icons">description</i> Assesstment Management
                    </li>
                    <li class="active"><i style="font-size: 20px;" class="material-icons"></i> RIASEC List
                    </li>
                </ol>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 25px; font-weight: 900; color: #752738;">
                                List of RIASEC
                            </h2>
                        </div>
                        <div class="body">
                            <div>
                                <a href="" class="btn bg-red waves-effect" style="margin-bottom: 15px;" data-toggle="modal" data-target="#addRiasecModal">+ ADD RIASEC</a>
                            </div>
                            @include('admin.riasec.modals.add_riasec')
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Initial</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Career Pathway / Related Courses</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $order = ['R', 'I', 'A', 'S', 'E', 'C'];
                                            uasort($formattedRiasec, function ($a, $b) use ($order) {
                                                $aIndex = array_search($a['id'], $order);
                                                $bIndex = array_search($b['id'], $order);
                                                return $aIndex - $bIndex;
                                            });
                                        @endphp

                                        @foreach ($formattedRiasec as $riasec_name => $riasec_formatting)
                                            <tr>
                                                <td>{{ $riasec_formatting['id'] }}</td>
                                                <td>{{ $riasec_name }}</td>
                                                <td>{{ $riasec_formatting['description'] }}</td>
                                                <td>
                                                    @foreach ($riasec_formatting['careers'] as $career)
                                                        <span style="color: #752738; font-weight: 900">{{ $career['name'] }}:</span>
                                                        @if (!empty($career['courses']))
                                                            @foreach ($career['courses'] as $courseId)
                                                                @php
                                                                    $courseName = $courses->firstWhere('id', $courseId)?->course_name;
                                                                @endphp
                                                                {{ $courseName ? $courseName : 'Course not found' }},<br>
                                                            @endforeach
                                                        @else
                                                            No courses available
                                                        @endif
                                                        <br>
                                                    @endforeach
                                                </td>
                                                <td>{{ $riasec_formatting['created_at'] }}</td>
                                                <td>{{ $riasec_formatting['updated_at'] }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i style="font-size: 15px" class="material-icons">more_vert</i>
                                                        </button>
                                                        <ul class="dropdown-menu" style="z-index: 9999; position: relative;">
                                                            <li><a href="javascript:void(0);" 
                                                                data-toggle="modal" 
                                                                data-target="#updateRiasecModal{{ $riasec_formatting['id'] }}">
                                                                EDIT</a></li>
                                                            <li><a href="javascript:void(0);"                 
                                                                data-toggle="modal" 
                                                                data-target="#deleteRiasecModal{{ $riasec_formatting['id'] }}">
                                                                DELETE</a></li>
                                                        </ul>
                                                    </div>

                                                    {{-- EDIT RIASEC MODAL --}}
                                                    @include('admin.riasec.modals.edit_riasec')

                                                    {{-- DELETE RIASEC MODAL --}}
                                                    @include('admin.riasec.modals.delete_riasec')
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
    <script src="{{ asset('admin/js/HoldOn.js') }}"></script>
    <script src="{{ asset('admin/js/pages/tables/jquery-datatable.js') }}"></script>

    {{-- AJAX REQUEST --}}
    <script src="{{ asset('admin/js/ajax/change_password/change_password.js')}}"></script>
    <script src="{{ asset('admin/js/ajax/course/add_course.js') }}"></script>
    <script src="{{ asset('admin/js/demo.js') }}"></script>

    {{-- FOR ADD MODAL --}}
    <script>
    let index = 1;
    document.getElementById('add-career-pathway').addEventListener('click', function () {
        const newField = document.createElement('div');
        newField.className = 'career-pathway';
        newField.innerHTML = `
            <div class="form-group">
                <label style="color: #212529; font-weight: 600;" class="form-label" for="career_name[]_${index}">Career Pathway</label>
                <div class="form-line">
                    <input type="text" class="form-control" name="career_name[]_${index}" id="career_name_${index}" required>
                    <div id="error-career-${index}" class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;"></div>
                </div>
            </div>
            <div class="form-group form-float">
                <label style="color: #212529; font-weight: 600; margin-top: 20px;" class="form-label" for="course_id[]">Select Related Courses</label>
                <div class="fields-scroll" style="margin-top: 5px">
                    <div>
                        @foreach ($courses as $course)
                            <div class="col-5">
                                <label>
                                    <input type="checkbox" class="filled-in chk-col-red" name="course_id[${index}][]" id="checkbox-${index}-{{ $course->id }}" value="{{ $course->id }}">
                                    <label for="checkbox-${index}-{{ $course->id }}" style="text-transform: uppercase">{{ $course->course_name }}</label>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn btn-danger waves-effect remove">Remove</button>
            </div>
        `;
        document.getElementById('career-pathway-fields').appendChild(newField);
        index++;
    });

    document.getElementById('career-pathway-fields').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove')) {
            e.target.closest('.career-pathway').remove();
        }
    });

    </script>

    {{-- FOR UPDATE MODAL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.body.addEventListener('click', function (e) {
                if (e.target.classList.contains('add-career-update-pathway')) {
                    const riasecId = e.target.id.split('-').pop();
                    const careerPathwayFields = document.getElementById(`career-update-pathway-fields-${riasecId}`);

                    if (careerPathwayFields) {
                        const updateIndex = careerPathwayFields.querySelectorAll('.career-update-pathway').length;

                        const newField = document.createElement('div');
                        newField.className = 'career-update-pathway';
                        newField.innerHTML = `
                            <div class="form-group" style="margin-bottom: 25px !important;">
                                <label style="color: #212529; font-weight: 600;" class="form-label">Career Name</label>
                                <div class="form-line">
                                    <input type="text" name="career_name[]" class="form-control" required>
                                    <div id="error-update-career-${updateIndex}" class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="color: #212529; font-weight: 600;" class="form-label">Select Related Courses</label>
                                <div class="fields-scroll">
                                    <div>
                                        @foreach ($courses as $course)
                                            <div class="col-5">
                                                <label>
                                                    <input type="checkbox" class="filled-in chk-col-red" name="course_id[${updateIndex}][]" id="update-checkbox-${riasecId}-${updateIndex}-{{ $course->id }}" value="{{ $course->id }}">
                                                    <label for="update-checkbox-${riasecId}-${updateIndex}-{{ $course->id }}" style="text-transform: uppercase">{{ $course->course_name }}</label>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                    <button type="button" style="margin-bottom: 25px;" class="btn btn-danger waves-effect remove">Remove</button>
                            </div>
                        `;
                        careerPathwayFields.appendChild(newField);
                    }
                }

                if (e.target.classList.contains('remove')) {
                    const pathway = e.target.closest('.career-update-pathway');
                    pathway.remove();
                    updateIndices();
                }
            });

            function updateIndices() {
                const careerPathwayFields = document.querySelectorAll('[id^="career-update-pathway-fields-"]');
                
                careerPathwayFields.forEach(fields => {
                    const pathways = fields.querySelectorAll('.career-update-pathway');
                    pathways.forEach((pathway, index) => {
                        const careerInput = pathway.querySelector('input[name="career_name[]"]');
                        if (careerInput) {
                            careerInput.name = 'career_name[]';
                        }

                        const checkboxes = pathway.querySelectorAll('input[type="checkbox"]');
                        checkboxes.forEach(checkbox => {
                            const courseId = checkbox.value;
                            checkbox.name = `course_id[${index}][]`;
                            checkbox.id = `update-checkbox-${fields.id.split('-').pop()}-${index}-${courseId}`;
                            checkbox.nextElementSibling.setAttribute('for', checkbox.id);
                        });
                    });
                });
            }
        });
    </script>


    
    <script src="{{ asset('admin/js/ajax/riasec/add_riasec.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/riasec/edit_riasec.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/riasec/delete_riasec.js') }}"></script>

</body>

</html>
