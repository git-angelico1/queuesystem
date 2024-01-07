<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A4Tech</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: url('wc.jfif') center center;
            background-size: cover;
            background-color: #f0f0f0; /* Fallback background color */
            selection-background-color: #ff0000; /* Selection background color */
            selection-color: #fff; /* Selection text color */
        }

        .content {
            text-align: right;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
        }

        .nav-link {
            font-weight: 600;
            color: #666;
            text-decoration: none;
            transition: color 0.3s;
            padding: 10px 20px; /* Add some padding to the links */
        }

        .nav-link:hover {
            color: #333;
        }

        /* Style for the "Log in" and "Register" links */
        .nav-link.login {
            background-color: lightblue;
            border-radius: 5px; /* Add rounded corners */
        }

        .nav-link.register {
            background-color: lightblue;
            border-radius: 5px; /* Add rounded corners */
        }
    </style>
</head>
<body>
    
    <div class="content">
        
        @if (Route::has('login'))
            <div class="nav-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link login">Log in</a> <!-- Added "login" class -->
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link register">Register</a> <!-- Added "register" class -->
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
