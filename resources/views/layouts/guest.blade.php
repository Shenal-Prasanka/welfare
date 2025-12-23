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
        /* Base Layout - No Scrolling */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            max-height: 100vh;
        }

        .oswald-font {
            font-family: 'Oswald', sans-serif !important;
        }

        .welcome-title {
            font-size: 48px;
            font-weight: 600;
            color: #b91c1c;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
            padding: 20px 0 10px 0;
            margin: 0;
        }

        .welcome-row {
            flex: 1 1 auto;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
            gap: 100px;
            overflow: hidden;
            min-height: 0;
        }

        .welcome-row img {
            width: 400px;
            height: 400px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .welcome-form {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            flex-shrink: 0;
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
            font-size: 14px;
            color: white;
            padding: 8px 0;
            text-align: center;
            margin-left: 0 !important;
            width: 100%;
            flex-shrink: 0;
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

        /* Laptop/PC Specific Responsive Design */
        
        /* Standard Laptop (1366x768) */
        @media (min-width: 1367px) and (max-width: 1440px) {
            .welcome-title {
                font-size: 36px;
                padding: 15px 0 8px 0;
            }
            
            .welcome-row {
                padding: 15px;
                gap: 50px;  /* Reduced gap */
            }
            
            .welcome-row img {
                width: 320px;
                height: 320px;
            }
            
            .login-box {
                max-width: 340px;
            }
            
            .card {
                padding: 15px;
            }
            
            footer.main-footer {
                font-size: 13px;
                padding: 6px 0;
            }
        }
        
        /* Large Desktop/PC (1920x1080 and above) */
        @media (min-width: 1441px) {
            .welcome-title {
                font-size: 42px;
                padding: 18px 0 10px 0;
            }
            
            .welcome-row {
                padding: 20px;
                gap: 120px;
            }
            
            .welcome-row img {
                width: 450px;
                height: 450px;
            }
            
            .login-box {
                max-width: 400px;
            }
            
            footer.main-footer {
                font-size: 15px;
                padding: 10px 0;
            }
        }
        
        /* Ultra-wide monitors */
        @media (min-width: 2560px) {
            .welcome-title {
                font-size: 52px;
            }
            
            .welcome-row {
                gap: 200px;
            }
            
            .welcome-row img {
                width: 550px;
                height: 550px;
            }
            
            .login-box {
                max-width: 450px;
            }
        }
        
        /* Specific fix for common laptop resolution */
        @media (width: 1366px) and (height: 768px) {
            .welcome-title {
                font-size: 32px;
                padding: 12px 0 6px 0;
            }
            
            .welcome-row {
                padding: 10px;
                gap: 30px;  /* Reduced gap */
            }
            
            .welcome-row img {
                width: 280px;
                height: 280px;
            }
            
            .login-box {
                max-width: 320px;
            }
            
            .card-body {
                padding: 15px;
            }
            
            footer.main-footer {
                font-size: 12px;
                padding: 5px 0;
            }
        }
        
        /* Minimum laptop screens (1024px - 1366px) */
        @media (min-width: 1024px) and (max-width: 1366px) {
            .welcome-title {
                font-size: 30px;
                padding: 10px 0 5px 0;
            }
            
            .welcome-row {
                padding: 8px;
                gap: 25px;  /* Minimal gap */
            }
            
            .welcome-row img {
                width: 260px;
                height: 260px;
            }
            
            .login-box {
                max-width: 310px;
            }
            
            .card-body {
                padding: 12px;
            }
            
            footer.main-footer {
                font-size: 12px;
                padding: 5px 0;
            }
        }
        
        /* Tablet and Mobile */
        @media (max-width: 1024px) {
            body {
                overflow-y: auto;
                overflow-x: hidden;
                max-height: none;
            }
            
            .welcome-title {
                font-size: 24px;
                padding: 10px 0;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                background: white;
                z-index: 10;
                margin: 0;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            
            .welcome-row {
                flex-direction: column;
                text-align: center;
                overflow-y: visible;
                padding: 10px;
                gap: 15px;
                margin-top: 50px;  /* Reduced margin to show logo immediately */
            }
            
            .welcome-row img {
                width: 200px;
                height: 200px;
                order: 1;  /* Logo shows first under title */
                margin-top: 0;
            }

            .welcome-form {
                padding: 0;
                margin-top: 0;
                order: 2;  /* Login form shows second */
            }
            
            footer.main-footer {
                position: relative;
                margin-top: 15px;
            }
        }
        
        /* Small Mobile */
        @media (max-width: 576px) {
            body {
                overflow-y: auto;
            }
            
            .welcome-title {
                font-size: 20px;
                padding: 8px 0;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                background: white;
                z-index: 10;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            
            .welcome-row {
                padding: 8px;
                gap: 12px;
                margin-top: 45px;  /* Reduced to show logo immediately */
            }
            
            .welcome-row img {
                width: 150px;
                height: 150px;
                margin-top: 0;
            }
            
            .login-box {
                max-width: 100%;
                padding: 0 10px;
            }
            
            .card-body {
                padding: 15px;
            }
            
            footer.main-footer {
                font-size: 12px;
                padding: 8px 0;
            }
        }
        
        /* Extra Small Mobile */
        @media (max-width: 375px) {
            body {
                overflow-y: auto;
            }
            
            .welcome-title {
                font-size: 18px;
                padding: 8px 0;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                background: white;
                z-index: 10;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            
            .welcome-row {
                margin-top: 42px;  /* Reduced to show logo immediately */
                padding: 8px;
                gap: 10px;
            }
            
            .welcome-row img {
                width: 130px;
                height: 130px;
                margin-top: 0;
            }
            
            .login-box {
                padding: 0 8px;
            }
            
            .card-body {
                padding: 12px;
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
