<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.8, maximum-scale=0.9, user-scalable=yes">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <!-- Font Awesome 6 CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Add Leaflet CSS & JS -->
    <link rel="preload" href="https://unpkg.com/leaflet/dist/leaflet.css" as="style">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js" defer></script>

    <!-- Custom Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <style>
        /* Base Styles */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
            font-size: 16px;
        }
        
        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }
        
        .main-header {
            flex-shrink: 0;
            z-index: 1031;
            position: relative;
        }
        
        .main-footer {
            flex-shrink: 0;
            background-color: #343a40;
            color: white;
            padding: 12px 20px;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            font-size: 0.9rem;
            z-index: 1030;
            width: calc(100% - 250px);
            position: fixed;
            bottom: 0;
            right: 0;
            text-align: center;
        }
        
        .content-wrapper {
            flex: 1 1 0;
            overflow-y: auto;
            overflow-x: hidden;
            background-color: #f4f6f9;
            margin-left: 250px;
            padding: 15px;
            padding-bottom: 60px; /* Add padding to prevent content from being hidden behind fixed footer */
            transition: margin-left 0.3s ease;
            min-height: 0;
        }
        
        .main-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            background-color: #343a40;
            z-index: 1030;
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform 0.3s ease;
        }

        /* Responsive Tables */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Responsive Cards */
        .card {
            margin-bottom: 1rem;
        }

        /* Responsive Images */
        img {
            max-width: 100%;
            height: auto;
        }

        /* Responsive Forms */
        .form-control, .form-select {
            width: 100%;
        }

        /* Laptop Screens - Ensure no horizontal scroll */
        @media (min-width: 1025px) and (max-width: 1440px) {
            .content-wrapper {
                padding: 12px;
            }
            
            .container-fluid {
                padding-left: 12px;
                padding-right: 12px;
            }
        }

        /* Tablets and Below (1024px and below) */
        @media (max-width: 1024px) {
            html, body {
                font-size: 15px;
            }
            
            .content-wrapper {
                padding: 10px;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
            
            h1 { font-size: 1.75rem; }
            h2 { font-size: 1.5rem; }
            h3 { font-size: 1.25rem; }
            h4 { font-size: 1.1rem; }
            h5 { font-size: 1rem; }
        }

        /* Mobile Landscape and Tablets (768px to 1024px) */
        @media (max-width: 1024px) and (min-width: 768px) {
            .main-sidebar {
                width: 220px;
            }
            
            .content-wrapper {
                margin-left: 220px;
            }
            
            .main-footer {
                margin-left: 220px;
                padding: 8px 12px;
                font-size: 0.85rem;
            }
        }

        /* Mobile Devices (767px and below) */
        @media (max-width: 767px) {
            html, body {
                font-size: 14px;
            }
            
            /* Hide sidebar by default on mobile */
            .main-sidebar {
                transform: translateX(-100%);
            }
            
            /* Show sidebar when toggled */
            body.sidebar-open .main-sidebar {
                transform: translateX(0);
            }
            
            /* Overlay when sidebar is open */
            body.sidebar-open::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1029;
            }
            
            .content-wrapper {
                margin-left: 0 !important;
                padding: 10px;
            }
            
            .main-footer {
                margin-left: 0 !important;
                padding: 6px 10px;
                font-size: 0.8rem;
            }
            
            /* Responsive navbar */
            .main-header {
                padding: 0.5rem;
            }
            
            .navbar-nav {
                flex-direction: row;
            }
            
            /* Responsive cards */
            .card-body {
                padding: 0.75rem;
            }
            
            /* Responsive buttons */
            .btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }
            
            .btn-block {
                width: 100%;
                display: block;
            }
            
            /* Responsive tables */
            .table {
                font-size: 0.85rem;
            }
            
            .table th, .table td {
                padding: 0.5rem;
            }
            
            /* Stack columns on mobile */
            .col-lg-6, .col-md-6, .col-sm-12 {
                width: 100%;
                margin-bottom: 1rem;
            }
            
            /* Responsive headings */
            h1 { font-size: 1.5rem; }
            h2 { font-size: 1.3rem; }
            h3 { font-size: 1.15rem; }
            h4 { font-size: 1rem; }
            h5 { font-size: 0.9rem; }
            
            /* Responsive forms */
            .form-group {
                margin-bottom: 0.75rem;
            }
            
            label {
                font-size: 0.9rem;
            }
            
            /* Responsive dropdowns */
            .dropdown-menu {
                font-size: 0.9rem;
            }
            
            /* Responsive badges */
            .badge {
                font-size: 0.75rem;
                padding: 0.25em 0.5em;
            }
            
            /* Hide text on small screens, show icons only */
            .btn .fa, .btn .fas, .btn .far {
                margin-right: 0;
            }
        }

        /* Small Mobile Devices (480px and below) */
        @media (max-width: 480px) {
            html, body {
                font-size: 13px;
            }
            
            .content-wrapper {
                padding: 8px;
            }
            
            .card-body {
                padding: 0.5rem;
            }
            
            .btn {
                padding: 0.35rem 0.7rem;
                font-size: 0.8rem;
            }
            
            .table {
                font-size: 0.75rem;
            }
            
            .table th, .table td {
                padding: 0.3rem;
            }
            
            h1 { font-size: 1.3rem; }
            h2 { font-size: 1.15rem; }
            h3 { font-size: 1rem; }
            h4 { font-size: 0.95rem; }
            h5 { font-size: 0.85rem; }
            
            /* Smaller user profile image */
            .navbar .nav-link img {
                width: 25px !important;
                height: 25px !important;
            }
            
            /* Compact sidebar */
            .main-sidebar {
                width: 200px;
            }
            
            .brand-text {
                font-size: 0.9rem;
            }
        }

        /* Large Screens (1920px and above) */
        @media (max-width: 767px) {
            .main-footer {
                margin-left: 0;
                width: 100%;
                text-align: center;
                position: static;
            }
            .content-wrapper {
                margin-left: 0;
                padding-bottom: 15px;
            }
            
            html, body {
                font-size: 17px;
            }
        }

        /* Additional Laptop/PC Footer Fix */
        @media (min-width: 1025px) {
            /* Ensure wrapper takes full viewport */
            .wrapper {
                min-height: 100vh;
                max-height: 100vh;
            }
            
            /* Content area calculation */
            .content-wrapper {
                max-height: calc(100vh - 57px - 40px); /* viewport - header - footer */
            }
            
            /* Smooth scrolling for content */
            .content-wrapper {
                scroll-behavior: smooth;
            }
        }

        /* Print Styles */
        @media print {
            .main-sidebar,
            .main-header,
            .main-footer,
            .btn,
            .no-print {
                display: none !important;
            }
            
            .content-wrapper {
                margin-left: 0 !important;
                padding: 0 !important;
            }
            
            .card {
                border: 1px solid #ddd;
                page-break-inside: avoid;
            }
        }

        /* Landscape Orientation for Mobile */
        @media (max-width: 767px) and (orientation: landscape) {
            .main-sidebar {
                width: 200px;
            }
            
            .content-wrapper {
                padding: 8px;
            }
        }

        /* Utility Classes for Responsive */
        .mobile-only {
            display: none;
        }
        
        .desktop-only {
            display: block;
        }
        
        @media (max-width: 767px) {
            .mobile-only {
                display: block;
            }
            
            .desktop-only {
                display: none;
            }
        }

    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link fw-bold" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i> {{ __(' Menu') }}
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                @if(!auth()->user()->hasRole('User'))
                    <!-- Notifications -->
                    <li class="nav-item" style="margin-right: 2px;">
                        <a class="nav-link position-relative d-flex align-items-center" href="{{ route('notifications.index') }}" title="Notifications">
                            <i class="fas fa-bell" style="font-size: 20px;"></i>
                            @php
                                $notificationCount = \App\Models\Notification::where('user_id', auth()->id())->where('is_read', false)->count();
                            @endphp
                            @if($notificationCount > 0)
                                <sup><span class="badge badge-danger" style="font-size: 10px; padding: 2px 5px;">{{ $notificationCount }}</span></sup>
                            @endif
                        </a>
                    </li>

                    <!-- Messages Notification -->
                    <li class="nav-item" style="margin-right: 2px;">
                        <a class="nav-link position-relative d-flex align-items-center" href="{{ route('messages.inbox') }}" title="Messages">
                            <i class="fas fa-envelope" style="font-size: 20px;"></i>
                            @php
                                $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
                            @endphp
                            @if($unreadCount > 0)
                                <sup><span class="badge badge-danger" style="font-size: 10px; padding: 2px 5px;">{{ $unreadCount }}</span></sup>
                            @endif
                        </a>
                    </li>
                @endif
                
                <!-- My Profile -->
                <li class="nav-item" style="margin-right: 2px;">
                    <a class="nav-link d-flex align-items-center" href="{{ route('profile.show') }}" title="My Profile">
                        @if(auth()->user()->profile_image)
                            <img src="{{ route('image.show', auth()->user()->profile_image) }}" style="width: 20px; height: 20px; object-fit: cover; border-radius: 50%;" alt="Profile">
                        @else
                            <i class="fas fa-user-circle" style="font-size: 20px;"></i>
                        @endif
                    </a>
                </li>

                <!-- Log Out -->
                <li class="nav-item" style="margin-right: 2px;">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link d-flex align-items-center" style="border: none; background: none; padding: 0.5rem 0.75rem;" title="Log Out">
                            <i class="fas fa-sign-out-alt" style="font-size: 20px;"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/" class="brand-link text-center d-flex ml-1">
                <img src="{{ asset('/public/images/logo.png') }}" class="brand-image img-circle elevation-3 mr-0" style="opacity: .8; float: none; display: inline-block;">
                <span class="brand-text font-weight-light ml-2">Welfareshop</span>
            </a>
          
                @include('layouts.navigation')
            
        </aside>

        <!-- Main Content -->
        <div class="content-wrapper bg-gray-light">
            @yield('content')
        </div>

        <!-- Control Sidebar (Optional) -->
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <strong>&copy; {{ date('Y') }} SUWARNA Welfareshop.</strong> All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    @vite('resources/js/app.js')
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery (required for Bootstrap's modal) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

    
    @yield('scripts')

    <script>
        $(function() {
            // Dropdown hover functionality
            $('.nav-item.dropdown').hover(
                function() {
                    $(this).find('.dropdown-toggle').attr('aria-expanded', 'true');
                    $(this).find('.dropdown-menu').addClass('show');
                },
                function() {
                    $(this).find('.dropdown-toggle').attr('aria-expanded', 'false');
                    $(this).find('.dropdown-menu').removeClass('show');
                }
            );

            // Mobile sidebar toggle
            $('[data-widget="pushmenu"]').on('click', function(e) {
                e.preventDefault();
                
                if (window.innerWidth <= 767) {
                    $('body').toggleClass('sidebar-open');
                }
            });

            // Close sidebar when clicking overlay on mobile
            $(document).on('click', function(e) {
                if (window.innerWidth <= 767 && $('body').hasClass('sidebar-open')) {
                    if (!$(e.target).closest('.main-sidebar').length && !$(e.target).closest('[data-widget="pushmenu"]').length) {
                        $('body').removeClass('sidebar-open');
                    }
                }
            });

            // Close sidebar when clicking a link on mobile
            $('.main-sidebar a').on('click', function() {
                if (window.innerWidth <= 767) {
                    $('body').removeClass('sidebar-open');
                }
            });

            // Handle window resize
            $(window).on('resize', function() {
                if (window.innerWidth > 767) {
                    $('body').removeClass('sidebar-open');
                }
            });
        });

        // Toastr notifications
        @if(session('success')) toastr.success("{{ session('success') }}"); @endif
        @if(session('warning')) toastr.warning("{{ session('warning') }}"); @endif
        @if(session('error')) toastr.error("{{ session('error') }}"); @endif
        @if(session('info')) toastr.info("{{ session('info') }}"); @endif

        // Delete confirmation
        $(".btn-delete").click(function(e){
            e.preventDefault();
            var form =$(this).parents("form");
            Swal.fire({
                title: "Are you sure?",
                text: "You want Delete this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Make DataTables responsive
        $(document).ready(function() {
            if ($.fn.DataTable) {
                $('.table').DataTable({
                    responsive: true,
                    autoWidth: false,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search..."
                    }
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
