<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UB - Assistments</title>
    <link rel="stylesheet" href="{{ asset('auth/css/login.css') }}">
    <link rel="shortcut icon" href="{{ asset('auth/images/ub-logo.png') }}" type="image/x-icon">
    <style>
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #752738;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .logo-preloader {
            width: 100px;
            animation: tibok 1s infinite;
        }

        @keyframes tibok {
            0% {
                transform: scale(1);
            }
            25% {
                transform: scale(1.2);
            }
            50% {
                transform: scale(1);
            }
            75% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div id="preloader">
        <img class="logo-preloader" src="{{ asset('auth/images/ub-logo.png') }}" alt="UB Logo" class="logo">
    </div>

    <div class="form-container">
        <div class="logo-title-wrapper">
            <div class="logo">
                <img style="cursor: pointer" onclick="window.location.href='{{ route('default.page') }}'" src="{{ asset('auth/images/ub-logo.png') }}" alt="UB Logo">
            </div>
            <h1 style="cursor: pointer" onclick="window.location.href='{{ route('default.page') }}'">Login Page</h1>
        </div>

        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.request') }}" method="POST">
            @csrf
            <label style="font-weight: 600;" for="email">Email</label>
            <input type="text" name="email" id="email" required>

            <label style="font-weight: 600;" for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('preloader').style.display = 'none';
        }, 1500);
    </script>
</body>
</html>
