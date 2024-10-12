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
    <link href="{{ asset('admin/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">
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
    .select-spacing {
        margin-right: 15px; /* Adjust spacing as needed */
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
                    <li class="active"><i style="font-size: 20px;" class="material-icons">badge</i> Examinees List
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
                                <button type="button" id="download-button" class="btn bg-red">
                                    <i class="material-icons">print</i>
                                    <span>Download for Print</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="row mb-3">
                            <div class="form-group">
                                <div style="display: flex; align-items: center; flex-wrap: wrap;">
                                    <label for="month" style="color: black; margin-left: 15px;" class="col-12 col-md-auto">Month & Year:</label>
                                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <select class="form-control show-tick select-spacing" id="month" name="month">
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <select class="form-control show-tick" id="year" name="year">
                                            @foreach (range(date('Y'), date('Y')) as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="printable-area" class="table-responsive mt-3">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
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
                                                    <button class="btn btn-danger waves-effect btn-sm" 
                                                            data-toggle="modal" 
                                                            data-target="#deleteExamineesModal{{ $examiner->id }}">
                                                        DELETE
                                                    </button>
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
    <script src="{{ asset('admin/js/pages/tables/examiners-table.js') }}"></script>


    {{-- AJAX REQUEST --}}
    <script src="{{ asset('admin/js/ajax/change_password/change_password.js')}}"></script>
    <script src="{{ asset('admin/js/ajax/examiners/delete_examiners.js')}}"></script>
    <script src="{{ asset('admin/js/ajax/examiners/print_examiners.js')}}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const monthInput = document.getElementById('month');
    const yearInput = document.getElementById('year');
    const downloadButton = document.getElementById('download-button');

    function fetchAndUpdateTable() {
        const month = monthInput.value;
        const year = yearInput.value;
        navigateLoading();

        fetch(`/get-examinees-month-year?month=${month}&year=${year}`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('#printable-area tbody');
                tbody.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(examiner => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${examiner.default_id}</td>
                            <td>${examiner.fullname}</td>
                            <td>${examiner.gender}</td>
                            <td>${examiner.age}</td>
                            <td>${examiner.birthday}</td>
                            <td>${examiner.strand}</td>
                            <td>
                                1.) ${examiner.course_1_name ?? 'N/A'} <br>
                                2.) ${examiner.course_2_name ?? 'N/A'} <br>
                                3.) ${examiner.course_3_name ?? 'N/A'}
                            </td>
                            <td>${examiner.created_at}</td>
                            <td>${examiner.updated_at}</td>
                            <td>
                                <button class="btn btn-danger waves-effect btn-sm delete-button" 
                                        data-id="${examiner.id}" 
                                        data-name="${examiner.fullname}">
                                    DELETE
                                </button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td style="text-align: center" colspan="10">No examinees available</td>`;
                    tbody.appendChild(row);
                }
            })
            .catch(error => console.error('Error fetching data:', error))
            .finally(() => {
                HoldOn.close();
            });
    }

    function navigateLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }

    document.querySelector('#printable-area').addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-button')) {
            const examinerId = event.target.getAttribute('data-id');
            const examinerName = event.target.getAttribute('data-name');

            const modalHTML = `
                <div class="modal fade" id="deleteExamineesModal${examinerId}" tabindex="-1" role="dialog" aria-labelledby="deleteExamineesModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteExamineesModalLabel">Confirm Deletion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this examiner "${examinerName}"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-red waves-effect delete-examiners-id" 
                                        data-url="/admin/examiners_list/delete/${examinerId}">DELETE</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', modalHTML);

            $('#deleteExamineesModal' + examinerId).modal('show');
            $('#deleteExamineesModal' + examinerId).on('hidden.bs.modal', function () {
                $(this).remove();
            });

            document.querySelector(`#deleteExamineesModal${examinerId} .delete-examiners-id`).addEventListener('click', function () {
                const deleteUrl = this.getAttribute('data-url');
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        swal({
                            title: "Deleted!",
                            text: "Examiner deleted successfully",
                            icon: "success",
                        }).then(() => {
                            $(`#deleteExamineesModal${examinerId}`).modal('hide'); 
                            location.reload();
                        });
                    } else {
                        console.error('Error deleting examiner:', response);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        }
    });


    monthInput.addEventListener('change', fetchAndUpdateTable);
    yearInput.addEventListener('change', fetchAndUpdateTable);

    downloadButton.addEventListener('click', function () {
        const month = monthInput.value;
        const year = yearInput.value;
        navigateLoading();

        fetch(`/get-examinees-month-year?month=${month}&year=${year}`)
            .then(response => response.json())
            .then(data => {
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();
                const columns = ["ID", "Fullname", "Gender", "Age", "Birthday", "Strand", "Preferred Course"];
                const rows = [];

                data.forEach(examiner => {
                    rows.push([
                        examiner.default_id,
                        examiner.fullname,
                        examiner.gender,
                        examiner.age,
                        examiner.birthday,
                        examiner.strand,
                        `${examiner.course_1_name || 'N/A'}, ${examiner.course_2_name || 'N/A'}, ${examiner.course_3_name || 'N/A'}`,
                        examiner.created_at,
                        examiner.updated_at
                    ]);
                });

                pdf.autoTable({
                    head: [columns],
                    body: rows,
                });

                pdf.save('Examinees-List.pdf');
            })
            .catch(error => console.error('Error fetching data:', error))
            .finally(() => {
                HoldOn.close();
            });
    });
});
</script>





    <script src="{{ asset('admin/js/demo.js') }}"></script>
</body>

</html>