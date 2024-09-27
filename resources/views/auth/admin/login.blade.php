<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Login Page</h1>
    <form action="{{ route('admin.login.request') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
