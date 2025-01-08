<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP AND FONTS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- WAVES -->
    <link href="{{ asset('examinees/plugins/node-waves/waves.css') }}" rel="stylesheet" />
    <!-- ANIMATION -->
    <link href="{{ asset('examinees/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    <!-- CUSTOM AND STYLE -->
    <link href="{{ asset('examinees/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('examinees/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('examinees/css/HoldOn.css') }}">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ asset('auth/images/ub-logo.png') }}" type="image/x-icon">
    <title>UB - Assistments</title>
</head>

<body>

    <div id="nav-bar" class="d-flex justify-content-center align-items-center">
        <div>
            <img class="ub-logo" src="{{ asset('auth/images/ub-logo.png') }}" alt="UB Logo" />
        </div>
        <div style="padding:10px;">
            <div>
                <div id="school-name">
                    UNIVERSITY OF BATANGAS LIPA CITY CAMPUS
                </div>
                <div class="sub-details">
                    Sample Address
                </div>
                <div class="sub-details">
                    www.ub.edu.ph / sample email
                </div>
                <div class="sub-details">
                    telefax: sample-number
                </div>
            </div>
        </div>
    </div>

    <div id="nav-body" class="d-flex justify-content-center" style="margin-bottom:50px;">
        <div id="form-container" class="row" style="background-color: #752738;">
            <div class="d-flex justify-content-end mt-4">
                <a class="btn btn-secondary waves-effect" style="margin-right: 5px;">Profile</a>
                <a class="btn btn-danger waves-effect" href="{{ route('users.logout.request') }}">Logout</a>
            </div>
            <h2 class="mt-2 mb-5 text-center w-100" style="color: white"><img style="height: 70px; border-radius: 50px;" src="{{ asset('examinees/images/copwell-logo.jpg') }}" alt=""> Welcome ID: {{ $examiners->default_id }}</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                </div>
            @endif

            <form method="POST" data-route-add-information="{{ route('users.add.information') }}" class="form-validation w-100">
                @csrf
                <div class="row" style="background-color: white; padding: 20px;">
                    <div class="col-md-6">
                        <h6>Personal Information</h6>
                        <div id="division"></div>
                        <div class="content mt-3">
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;"
                                            class="form-label">Fullname</label>
                                        <div class="form-line">
                                            <input style="background-color: gray; color: white; padding: 10px;" type="text" class="form-control" name="fullname" value="{{ $examiners->fullname }}" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;" class="form-label">Email</label>
                                        <div class="form-line">
                                            <input style="background-color: gray; color: white; padding: 10px;" type="email" class="form-control" name="email" value="{{ $examiners->email}} " required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;"
                                            class="form-label">Birthday</label>
                                        <div class="form-line">
                                            <input style="background-color: gray; color: white; padding: 10px;" type="date" class="form-control" name="birthday" value="{{ $examiners->birthday }}" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;" class="form-label">Sex</label>

                                        <div class="form-line">
                                            <input style="background-color: gray; color: white; padding: 10px; text-transform: capitalize;" type="text" class="form-control" name="gender" value="{{ $examiners->gender }}" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;" class="form-label">Age</label>

                                        <div class="form-line">
                                            <input style="background-color: gray; color: white; padding: 10px;" type="text" class="form-control" name="age" value="{{ $examiners->age }}" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;" class="form-label">Strand</label>
                                        <div class="form-line">
                                            <input style="background-color: gray; color: white; padding: 10px;" type="text" class="form-control" name="strand" value="{{ $examiners->strand }}" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6>Please select top 3 preferred course</h6>
                        <div id="division"></div>
                        <div class="content mt-3">
                            <div class="justify-content-between row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Course 1</label>
                                            <select class="form-select" style="border: none !important;" name="course_1" required>
                                                <option value="">Select a course</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="justify-content-between row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Course 2</label>
                                            <select class="form-select" style="border: none !important;" name="course_2" required>
                                                <option value="">Select a course</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="justify-content-between row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Course 3</label>
                                            <select class="form-select" style="border: none !important;" name="course_3" required>
                                                <option value="">Select a course</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary waves-effect">
                        Submit
                    </button>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4 mb-4">                   
                </div>
            </form>
        </div>
    </div>

    <div id="changePasswordModal" class="modal" style="display: none;">
        <div class="modal-dialog" style="width: 100%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button class="btn-close" onclick="closeChangePasswordModal()"></button>
                </div>
                <div id="division-modal"></div>
                <div class="modal-body mt-3">
                    <form id="changePasswordForm" method="POST" action="{{ route('users.change.password') }}">
                        @csrf

                        <div class="mb-3">
                            <label style="color: black" for="newPassword" class="form-label">Default ID</label>
                            <input style="background-color: gray; color: white;" type="text" class="form-control" value="{{ $examiners->default_id }}" readonly>
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
                    <button type="submit" class="btn btn-secondary">Change Password</button>
                    <button class="btn btn-info" onclick="closeChangePasswordModal()">Cancel</button>
                </div>
                    </form>
            </div>
        </div>
    </div>


    <div id="customModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Instructions</h5>
                </div>
                <div id="division-modal"></div>
                <div class="modal-body">
                    <p>1. Please ensure you fill out all fields with accurate information.</p>
                    <p>2. Once you begin the assessment, you will not be able to go back, close the window, and retake
                        it. Please review your entries carefully before submission.</p>
                    <p>3. The instructor will provide the time by which you must submit the exam.</p>
                    <p>4. You can view the suggested top course results that are suitable for you after the examination.</p>
                </div>
                <div class="modal-footer">
                    <button onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JQUERY JS -->
    <script src="{{ asset('examinees/plugins/jquery/jquery.min.js') }}"></script>
    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('examinees/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <!-- SLIMSCROLL JS -->
    <script src="{{ asset('examinees/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- JQUERY VALIDATION JS -->
    <script src="{{ asset('examinees/plugins/jquery-validation/jquery.validate.js') }}"></script>
    <!-- JQUERY STEPS JS -->
    <script src="{{ asset('examinees/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <!-- SWEETALERT JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- HOLD ON --}}
    <script src="{{ asset('examinees/js/HoldOn.js') }}"></script>
    <!-- WAVES EFFECTS JS -->
    <script src="{{ asset('examinees/plugins/node-waves/waves.js') }}"></script>
    <!-- CUSTOM JS -->
    <script src="{{ asset('examinees/js/admin.js') }}"></script>
    <script src="{{ asset('examinees/js/form-validation.js') }}"></script>
    <script src="{{ asset('examinees/js/modals.js') }}"></script>
    <script src="{{ asset('examinees/js/ajax/personal_information.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courseSelects = document.querySelectorAll('select[name^="course_"]');

            function updateOptions() {
                const selectedCourses = Array.from(courseSelects)
                    .map(select => select.value)
                    .filter(value => value);

                courseSelects.forEach(select => {
                    const options = Array.from(select.querySelectorAll('option'));
                    options.forEach(option => {
                        option.style.display = selectedCourses.includes(option.value) && option.value !== '' ? 'none' : 'block';
                    });
                });
            }

            courseSelects.forEach(select => {
                select.addEventListener('change', updateOptions);
            });

            updateOptions();
        });
    </script>

</body>
</html>