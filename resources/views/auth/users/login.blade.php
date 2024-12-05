<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UB - Assistments</title>
    <link rel="stylesheet" href="{{ asset('auth/css/login.css') }}">
    <link rel="shortcut icon" href="{{ asset('auth/images/ub-logo.png') }}" type="image/x-icon">
</head>
<body>
    <div class="form-container">
        <div class="logo-title-wrapper">
            <div class="logo">
                <img src="{{ asset('auth/images/ub-logo.png') }}" alt="UB Logo">
            </div>
            <h1>Login Page</h1>
        </div>

        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('users.login.request') }}" method="POST">
            @csrf
            <label style="font-weight: 600;" for="default_id">Examiners ID</label>
            <input type="text" name="default_id" id="default_id" required>

            <label style="font-weight: 600;" for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
