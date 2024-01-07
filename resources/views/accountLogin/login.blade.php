<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: gray;
        }

        .card {
            border: none;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            padding: 20px;
            width: 350px;
        }

        .card-header {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="email"],
        input[type="password"] {
            border: none;
            border-bottom: 1px solid black;
            margin-bottom: 20px;
            padding: 10px;
            outline: none;
        }

        input[type="submit"] {
            align-self: center;
            width: 100px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
            text-decoration: underline;
            color: black;
            font-weight: bold;
        }

        .register-link:hover {
            text-decoration: underline;
            color: #4CAF50;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            text-align: center;
            width: 100%;
            color: #000;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">Login</div>
        <form action="{{ route('authenticate') }}" method="post">
            @csrf
            <input type="email" class="@error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
            <input type="password" class="@error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
            <input type="submit" value="Login">
        </form>
        <a class="register-link" href="{{ route('register') }}">Register Here</a>
    </div>
    <div class="footer">
        © A4TECH 2023. All Rights Reserved.
    </div>
</body>

</html>
