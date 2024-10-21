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
    <!-- Morris Chart Css-->
    <link href="{{ asset('admin/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                YEARLY EXAMINEES
                            </h2>
                        </div>
                        <div class="body">
                            <canvas id="yearlyExaminees" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                EXAMINERS BASED ON GENDER
                            </h2>
                        </div>
                        <div class="body">
                            <canvas id="gender-chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                OFFERED COURSE
                            </h2>
                        </div>
                        <div class="body">
                            <canvas id="course-chart" height="150"></canvas>
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
                            <canvas id="preferred-course-chart" height="150"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 17px; font-weight: 900; color: #752738;">
                                RIASEC BASED USER SCORES ANALYTICS
                            </h2>
                        </div>
                        <div class="body">
                            <form action="">
                                <div class="form-group" style="display: flex; align-items: center;">
                                    <label for="year-select" style="font-weight: 600; margin-right: 10px;">Year:</label>
                                    <div class="form-line" style="width: 100px">
                                        <select class="form-control show-tick" id="year-select" style="border: none; box-shadow: none;">
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="riasec-chart" style="height: 250px;"></div>
                            </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom Js -->
    <script src="{{ asset('admin/js/pages/forms/form-validation.js') }}"></script>
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script src="{{ asset('admin/js/pages/index.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/dashboard_analytics/dashboard_chart.js')}}"></script>
    {{-- Gender Chart Analytics --}}
    <script>
        fetch('/admin/examiners/data-gender')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.gender);
                const counts = data.map(item => item.count);

                const maleCount = counts[labels.indexOf("Male")] || 0;
                const femaleCount = counts[labels.indexOf("Female")] || 0;

                const ctx = document.getElementById('gender-chart').getContext('2d');

                const genderChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Female', 'Male'],
                        datasets: [{
                            label: 'Total',
                            data: [femaleCount, maleCount],
                            backgroundColor: ['rgba(255, 105, 180, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                            borderColor: ['rgba(255, 105, 180, 1)', 'rgba(75, 192, 192, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>

    {{-- Course Chart Analytics --}}
<script>
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    fetch('/admin/courses/offered')
        .then(response => response.json())
        .then(data => {
            const courseLabels = Object.keys(data.offered_courses);
            const courseCounts = Object.values(data.offered_courses);
            const backgroundColors = courseLabels.map(() => getRandomColor());
            const borderColors = courseLabels.map(() => getRandomColor());

            const ctx = document.getElementById('course-chart').getContext('2d');

            const courseChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: courseLabels,
                    datasets: [{
                        label: 'Offered Courses',
                        data: courseCounts,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
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
                                    return tooltipItem.label || '';
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching course data:', error);
        });
</script>

{{-- PREFERRED COURSE --}}
<script>
    fetch('/admin/preferred-courses/counts')
        .then(response => response.json())
        .then(data => {
            const courseLabels = Object.keys(data);
            const courseCounts = Object.values(data);
            const colors = [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 99, 71, 0.5)',
                'rgba(60, 179, 113, 0.5)',
                'rgba(255, 20, 147, 0.5)',
                'rgba(255, 165, 0, 0.5)'
            ];

            const datasetColors = courseLabels.map((_, index) => colors[index % colors.length]);

            const ctx = document.getElementById('preferred-course-chart').getContext('2d');

            const preferredCourseChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: courseLabels,
                    datasets: [{
                        label: 'Number of Students',
                        data: courseCounts,
                        backgroundColor: datasetColors,
                        borderColor: datasetColors.map(color => color.replace('0.5', '1')),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        r: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching preferred course data:', error);
        });
</script>

{{-- RIASEC based on user scores analytics --}}
<script>
    let morrisBarChart;

    function fetchRiasecData(year) {
        fetch(`/admin/riasec/scores?year=${year}`)
            .then(response => response.json())
            .then(data => {
                const riasecOrder = ['R', 'I', 'A', 'S', 'E', 'C'];
                const chartData = [];

                riasecOrder.forEach(riasec => {
                    chartData.push({ riasec: riasec, points: 0, courses: '' });
                });

                data.chartData.forEach(item => {
                    const index = riasecOrder.indexOf(item.riasec.charAt(0));
                    if (index !== -1) {
                        chartData[index].points = item.points;
                        chartData[index].courses = item.courses;
                    }
                });

                const sortedChartData = chartData.sort((a, b) => {
                    return riasecOrder.indexOf(a.riasec) - riasecOrder.indexOf(b.riasec);
                });

                if (morrisBarChart) {
                    morrisBarChart.setData(sortedChartData);
                } else {
                    morrisBarChart = new Morris.Bar({
                        element: 'riasec-chart',
                        data: sortedChartData,
                        xkey: 'riasec',
                        ykeys: ['points'],
                        labels: ['Total Points'],
                        barColors: ['#752738'],
                        xLabelAngle: 60,
                        hideHover: 'auto',
                        barSizeRatio: 0.5,
                        hoverCallback: function(index, options, content, row) {
                            return `<div style="text-align: left;">
                                        <strong>${row.riasec}</strong><br>
                                        <strong>Total Points: (${row.points})</strong><br>
                                        <strong>Career / Related Courses:</strong><br>
                                        ${row.courses}
                                    </div>`;
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching RIASEC data:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const currentYear = new Date().getFullYear();
        fetchRiasecData(currentYear);

        document.getElementById('year-select').addEventListener('change', function() {
            const selectedYear = this.value;
            fetchRiasecData(selectedYear);
        });
    });
</script>

    <script src="{{ asset('admin/js/ajax/change_password/change_password.js')}}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('admin/js/demo.js') }}"></script>
</body>

</html>