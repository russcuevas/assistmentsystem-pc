<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UB - Assistments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('auth/images/ub-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('default/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" />
    <style>
        .slick-container img {
            width: 100%;
            height: auto;
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

    <header>
        <h1>Welcome to UB Assistments</h1>
        <p></p>
    </header>

    <div class="container">
    <h3 class="mt-5">BROWSE COURSE</h3>
    <div class="row">
        @foreach($courses as $course)
        <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex align-items-stretch">
            <div class="course-card d-flex flex-column">
                @if($course->course_picture && is_array($course->course_picture))
                    <div class="slick-container">
                        @foreach($course->course_picture as $picture)
                            <img style="height: 300px" src="{{ asset('storage/course/course_picture/' . $picture) }}" alt="{{ $course->course_name }}">
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('default-course-image.jpg') }}" alt="{{ $course->course_name }}">
                @endif
                <h2>{{ $course->course_name }}</h2>
                <p>{{ \Illuminate\Support\Str::limit($course->course_description, 100) }}</p>
                <div class="mt-auto">
                    <a href="{{ route('show.course', $course->id) }}" class="btn btn-primary learn-btn">Learn More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.slick-container').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 2000,
                adaptiveHeight: true
            });
        });
    </script>
</body>

</html>
