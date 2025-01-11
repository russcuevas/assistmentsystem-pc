<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('auth/images/ub-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('examinees/css/completed_style.css') }}">
    <title>UB - Assistments</title>
    <style>
        .highlight {
            font-weight: bold;
            color: red;
        }
        h1, h2 {
            color: #333;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto;
        }

        .modal-content {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0.3rem;
            box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
            outline: 0;
            animation: showModal 0.3s ease-out;
        }

        @keyframes showModal {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            border-top-left-radius: 0.3rem;
            border-top-right-radius: 0.3rem;
        }

        .modal-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 500;
        }

        .modal-body {
            padding: 1rem;
            color: #212529;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            padding: 0.75rem;
            border-top: 1px solid #dee2e6;
        }

        .close {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000;
            border: none;
            background: none;
            cursor: pointer;
        }

        .close:hover {
            color: #752738;
        }

        .modal-trigger {
            background-color: #17a2b8;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="nav-bar" class="d-flex justify-content-center align-items-center">
        <div>
            <img class="ub-logo" src="{{ asset('auth/images/ub-logo.png') }}" alt="UB Logo" />
        </div>
        <div style="padding:10px;">
            <div>
                <div id="school-name">
                    UNIVERSITY OF BATANGAS LIPA CITY
                </div>
                <div class="sub-details">
                    Gov. Feliciano Leviste Road, Lipa City, Philippines
                </div>
                <div class="sub-details">
                    ublc@ub.edu.ph
                </div>
                <div class="sub-details">
                    (043) 706 0041
                </div>
            </div>
        </div>
    </div>

    <div id="nav-body" class="d-flex justify-content-center" style="margin-bottom:50px;">
        <div id="form-container">
            <div class="title">
                <div style="display:flex; justify-content: center;">
                    <div>
                        <img style="height: 100px !important; border: 1px solid black; border-radius: 50px;" src="{{ asset('examinees/images/copwell-logo.jpg') }}" />
                    </div>
                    <div style="margin-top: 15px">
                        RIASEC RESULTS
                        <span style="font-size: 9px !important; display: block; margin-top: 0;">Realistic / Investigative / Artistic / Social / Enterprising / Conventional</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mt-3">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                </div>
            @endif

            <div id="division"></div>
            <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
                <h2>PERSONAL DETAILS</h2>
                <div>
                <a class="btn btn-secondary waves-effect" style="margin-right: 5px;">Profile</a>
                    <a href="{{ route('users.logout.request') }}" class="btn btn-danger">Logout</a>
                </div>
            </div>
            
            <ul class="mb-5">
                <strong>Fullname:</strong> {{ $user->fullname }}<br>
                <strong>Gender:</strong> <span style="text-transform: capitalize;">{{ $user->gender }}</span><br>
                <strong>Age:</strong> {{ $user->age }}<br>
                <strong>Birthday:</strong> {{ \Carbon\Carbon::parse($user->birthday)->format('F j, Y') }}<br>
                <strong>Strand:</strong> {{ $user->strand }}<br>
                <strong>Preferred Course</strong><br> →
                    <span>{!! implode('<br> → ', $preferredCourseNames) !!}</span>
            </ul>
            
            <div id="division"></div>
            <h2 class="mt-5 mb-5">MY INTEREST CODE</h2>
            

            <div class="row">
                <div class="col-md-6">
                    <h2>Top 3 Highest Points in the RIASEC</h2>
                    <ul>
                        @foreach ($top_scores as $riasec_id => $total_points)
                            <li>{{ $riasec_id }} ({{ $riasec_names[$riasec_id] ?? 'N/A' }}) = {{ $total_points }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-6">
                    <h2>Total Points for Each RIASEC</h2>
                    <ul>
                        @foreach ($riasec_order as $riasec_id)
                            <li>{{ $riasec_id }} ({{ $riasec_names[$riasec_id] ?? 'N/A' }}) = {{ $all_scores[$riasec_id] ?? 0 }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5 mb-5">
                <div style="width: 50%;">
                    <canvas id="myDonutChart" width="400" height="400"></canvas>  
                </div>
            </div>

            <div id="division"></div>
            <br>
            <br>
            <h2>Suggested Courses for Top 3 RIASEC <br> <span style="color: brown; font-size: 20px"><i>(the highlighted course related to your preferred course)</i></span></h2><br><br>
            <h6 style="color: brown; font-weight: 900;">SUGGESTED COURSE</h6>
            <ul class="mb-5">
                @foreach ($top_scores as $riasec_id => $total_points)
                    @if (isset($groupedPreferredCourses[$riasec_id]))
                        <li>
                            @php
                                $firstCareer = array_key_first($groupedPreferredCourses[$riasec_id]);
                                $riasecName = $groupedPreferredCourses[$riasec_id][$firstCareer][0]['riasec_name'] ?? '';
                            @endphp
                            <span style="font-weight: 900">{{ $riasecName }}</span>
                            
                            @foreach ($groupedPreferredCourses[$riasec_id] as $careerName => $courses)
                                <br>{{ $careerName }}:<br>
                                @foreach ($courses as $course)
                                    <span class="{{ in_array($course['id'], $preferredCourseIds) ? 'highlight' : '' }}">
                                        {{ $course['name'] }}<br>
                                    </span>
                                @endforeach
                            @endforeach
                        </li>
                    @endif
                @endforeach
            </ul>

        </div>

        <div id="changePasswordModal" class="modal" style="display: none;">
        <div class="modal-dialog" style="width: 100%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button class="btn-close" onclick="closeChangePasswordModal()"></button>
                </div>
                <div class="modal-body mt-3">
                    <form id="changePasswordForm" method="POST" action="{{ route('users.change.password') }}">
                        @csrf

                        <div class="mb-3">
                            <label style="color: black" for="newPassword" class="form-label">Default ID</label>
                            <input style="background-color: gray; color: white;" type="text" class="form-control" value="{{ $user->default_id }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label style="color: black" for="newPassword" class="form-label">New Password</label>
                            <input style="border: 2px solid black;" type="password" class="form-control" id="newPassword" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label style="color: black" for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input style="border: 2px solid black;" type="password" class="form-control" id="confirmPassword" name="new_password_confirmation" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #5b1b2b !important; border: none;">Change Password</button>
                    <button class="btn btn-secondary" onclick="closeChangePasswordModal()">Cancel</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myDonutChart').getContext('2d');
        const data = {
            labels: ['Realistic', 'Investigative', 'Artistic', 'Social', 'Enterprising', 'Conventional'],
            datasets: [{
                label: 'Points',
                data: [
                    {{ $all_scores['R'] ?? 0 }},
                    {{ $all_scores['I'] ?? 0 }},
                    {{ $all_scores['A'] ?? 0 }},
                    {{ $all_scores['S'] ?? 0 }},
                    {{ $all_scores['E'] ?? 0 }},
                    {{ $all_scores['C'] ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'RIASEC SCORE GRAPH',
                        font: {
                            size: 30 // Adjust the size value as needed
                        }
                    }

                }
            },
        };

        const myDonutChart = new Chart(ctx, config);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const changePasswordButton = document.querySelector('.btn-secondary.waves-effect');
    const changePasswordModal = document.getElementById('changePasswordModal');

    changePasswordButton.addEventListener('click', function () {
        changePasswordModal.style.display = 'flex';
    });

    function closeChangePasswordModal() {
        changePasswordModal.style.display = 'none';
    }

    window.onclick = function (event) {
        if (event.target === changePasswordModal) {
            closeChangePasswordModal();
        }
    };

    window.closeChangePasswordModal = closeChangePasswordModal; // Expose to global scope
});

    </script>
</body>
</html>
