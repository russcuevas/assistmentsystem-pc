<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UB Assistments</title>
    <link rel="shortcut icon" href="{{ asset('auth/images/ub-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('default/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css">
    <style>
        .course-image {
            width: 50%;
        }

        .slick-slide img {
            display: inline-block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('default.page') }}">
                <img style="height: 60px" src="{{ asset('default/images/default-logo.jpg') }}" alt="UB Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login.page') }}">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.login.page') }}">Examiners Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>{{ $course->course_name }}</h1>

        <!-- Slick Carousel -->
        @if($course->course_picture && is_array($course->course_picture))
        <div class="slick-container mb-4">
            @foreach($course->course_picture as $picture)
            <div>
                <img src="{{ asset('storage/course/course_picture/' . $picture) }}" 
                     alt="{{ $course->course_name }}" class="img-fluid course-image">
            </div>
            @endforeach
        </div>
        @else
        <img src="{{ asset('default-course-image.jpg') }}" 
             alt="{{ $course->course_name }}" class="img-fluid mb-4 course-image">
        @endif

        <p><strong>Course Description:</strong></p>
        <p>{{ $course->course_description }}</p>

        <a href="{{ route('default.page') }}" class="btn btn-secondary mb-5">Back to Courses</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.slick-container').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 2000
            });
        });
    </script>
</body>

</html>
