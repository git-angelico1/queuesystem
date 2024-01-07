<!DOCTYPE html>
<html lang="en">

<head>
    <title>FINANCE</title>
    <style>
        body {
            background-color: skyblue;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            width: 500px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.5s ease-in-out;
        }

        .login-container:hover {
            transform: scale(1.05);
        }

        .login-header {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .login-form {
            padding: 20px;
            position: relative;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input {
            width: 95%;
            padding: 10px;
            border: 4px solid #ced4da;
            border-radius: 4px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007bff;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 2px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .bottom-text {
            text-align: center;
            margin-top: 20px;
        }

        .show-password-icon {
            position: absolute;
            top: 59%;
            right: 25px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .notification {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .login-success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background: transparent;
            border: 2px solid black;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 24px;
            color: #fff;
            transition: transform 0.3s;
        }

        .back-button:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>
<button class="back-button" onclick="history.go(-1)">&#8592;</button>
    <div class="login-container">
        <div class="login-header">
            <h2>FINANCE DEPARTMENT</h2>
            <h2>Login</h2>
        </div>
        <div class="login-form">
            <form action="{{ route('finance.login') }}" method="post" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="Username" name="Username" autocomplete="current-username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="Password" name="Password" autocomplete="current-password" required>
                    <span class="show-password-icon" onclick="togglePasswordVisibility()">👁️</span>
                </div>
                <button class="login-btn" type="submit">Login</button>
                <p id="errorMessage" class="notification"></p>
                <p id="loginSuccess" class="login-success">{{ session('success') }}</p>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('Password');
            passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';
        }

        var errorMessage = "{{ session('error') }}";
        if (errorMessage) {
            document.getElementById('errorMessage').innerText = errorMessage;
        }
    </script>

</body>

</html>
