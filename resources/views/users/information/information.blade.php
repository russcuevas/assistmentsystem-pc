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
    <!-- SWEETALERT -->
    <link href="{{ asset('examinees/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
    <!-- CUSTOM AND STYLE -->
    <link href="{{ asset('examinees/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('examinees/css/custom.css') }}" rel="stylesheet">
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
        <div id="form-container" class="row">
            <div class="d-flex justify-content-end mt-4">
                <a class="btn btn-danger waves-effect" href="{{ route('users.logout.request') }}">Logout</a>
            </div>
            <h2 class="mt-2 mb-5 text-center w-100">Welcome ID: {{ $examiners->default_id }}</h2>
            <form id="form_validation" method="POST" class="w-100" action="{{ route('users.add.information') }}">
                @csrf
                <div class="row">
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
                                            <input type="text" class="form-control" name="fullname" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;" class="form-label">Email</label>
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="email" required>
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
                                            <input type="date" class="form-control" name="birthday" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;" class="form-label">Sex</label>
                                        <div class="form-line">
                                            <select class="form-select" style="border: none !important;" name="gender" id="">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;" class="form-label">Age</label>

                                        <div class="form-line">
                                            <input type="text" class="form-control" name="age" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label style="margin-bottom: 0px !important;" class="form-label">Strand</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="strand" required>
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
                </div>
                <div class="d-flex justify-content-end mt-4 mb-4">
                    <button type="submit" class="btn btn-primary waves-effect">
                        Submit
                    </button>
                </div>
            </form>
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
    <script src="{{ asset('examinees/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!-- WAVES EFFECTS JS -->
    <script src="{{ asset('examinees/plugins/node-waves/waves.js') }}"></script>
    <!-- CUSTOM JS -->
    <script src="{{ asset('examinees/js/admin.js') }}"></script>
    <script src="{{ asset('examinees/js/form-validation.js') }}"></script>
    <script src="{{ asset('examinees/js/modals.js') }}"></script>

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
