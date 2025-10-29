<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'WelfareShop') }}</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-size: cover;
            height: 100vh;
            margin: 0;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }


        .oswald-font {
            font-family: 'Oswald', sans-serif !important;
        }

        .welcome-title {
            font-size: 48px;
            font-weight: 600;
            color: #b91c1c;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-row {
            flex: 1;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
            gap: 200px;
        }

        .welcome-row img {
            width: 600px;
            height: 600px;
            object-fit: contain;
        }


        .welcome-form {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        footer.main-footer {
            background-color: #1f2937 !important;
            font-size: 16px;
            color: white;
            padding: 10px 0;
            text-align: center;
            margin-left: 0 !important;
            width: 100%;
        }

        /* Form container */
        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            /* Adjust as needed */
            text-align: left;
        }

        /* Header/Logo section */
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #0d47a1;
            /* Dark blue from the logo */
            margin: 0;
        }

        .login-header p {
            font-size: 16px;
            color: #666;
            margin: 0;
        }

        /* Form inputs and labels */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            /* Ensures padding doesn't affect total width */
            transition: border-color 0.3s;
        }

        .form-control-custom:focus {
            border-color: #0d47a1;
            outline: none;
        }

        /* Checkbox and Forgot Password link */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-options .checkbox-container {
            display: flex;
            align-items: center;
        }

        .form-options input[type="checkbox"] {
            margin-right: 8px;
        }

        .form-options a {
            color: #0d47a1;
            text-decoration: none;
            font-size: 14px;
        }

        .form-options a:hover {
            text-decoration: underline;
        }

        /* Sign In button */
        .btn-signin {
            width: 100%;
            padding: 15px;
            background-color: #0d47a1;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-signin:hover {
            background-color: #0a3a7f;
        }

        /* Optional: for error messages */
        .invalid-feedback {
            display: block;
            color: #e3342f;
            margin-top: 5px;
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .welcome-row {
                flex-direction: column;
                text-align: center;
            }

            .welcome-form {
                padding: 0;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Title -->
    <h2 class="welcome-title oswald-font text-center pt-4">
        Welcome to Army WelfareShop
    </h2>

    <!-- Main Content Row -->
    <div class="welcome-row">
        <!-- Left Side Image -->
        <img src="{{ asset('/public/images/logo.png') }}">

        <!-- Right Side Login Box -->
        <div class="welcome-form">
            <div class="login-box">
                <div class="login-logo oswald-font">
                    <a href="/" style="color:#1f2937; font-weight:bold; font-size:24px;">
                        {{ config('app.name', 'WelfareShop') }}
                    </a>
                </div>
                <div class="card">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>&copy; 2025 Directorate of Information Technology.</strong> All rights reserved.
    </footer>

    @vite('resources/js/app.js')
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/js/adminlte.min.js') }}" defer></script>
</body>

</html>
