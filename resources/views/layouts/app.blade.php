<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <link rel="icon" href="{{ asset('icon/CHECKLOGO-Transparent.png') }}" style="background-color: #fff;" type="image/png">
        <script src="{{ asset('js/signature_pad.umd.min.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.css') }}">

        <style>
            /* ===== Global Theme Variables ===== */
            :root {
                --primary: #2b4b7b;
                --primary-hover: #ffffff;
                --primary-active: #1e3557;
            }

            /* ===== Base Styles ===== */
            body {
                font-family: 'Nunito', sans-serif;
                background: #f8f9fa;
                margin: 0;
            }

            #app {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            /* ===== Navbar ===== */
            .navbar {
                background: var(--primary) !important;
            }
            .navbar .nav-link.active {
                color: #0d6efd;
                font-weight: 600;
            }
            .navbar-brand {
                color: #ffffff !important;
            }

            /* ===== Sidebar ===== */
            .sidebar {
                width: 220px;
                position: fixed;
                top: 56px;
                left: 0;
                bottom: 0;
                background: var(--primary);
                overflow-y: auto;
                padding-top: 1rem;
                transition: transform 0.3s ease;
            }
            .sidebar .nav-link {
                color: #ffffff;
                margin: 0.25rem 0.75rem;
                border-radius: 8px;
                display: flex;
                align-items: center;
                gap: 10px;
                transition: all 0.2s;
                width: 100%;
            }
            .sidebar .nav-link:hover {
                background: #e9f2ff;
                color: var(--primary);
            }
            .sidebar .nav-link.active {
                background: #ffffff;
                color: var(--primary);
            }

            /* ===== Content Wrapper ===== */
            .content-wrapper {
                margin-left: 220px;
                padding: 1rem;
                transition: margin-left 0.3s ease;
            }
            .content-full {
                margin-left: 0 !important;
            }
            .sidebar-collapsed {
                transform: translateX(-100%);
            }

            /* Mini sidebar - only icons visible */
            /* Sidebar collapsed mini */
            .sidebar.mini {
                width: 60px; /* narrow width */
                overflow: hidden;
                transition: width 0.3s ease;
            }

            /* Center icons in mini mode */
            .sidebar.mini .nav-link {
                justify-content: center;
                padding-left: 0;
                padding-right: 0;
            }

            .sidebar.mini .nav-link span {
                display: none; /* hide text */
            }

            .sidebar.mini .collapse {
                display: none !important; /* hide submenus */
            }

            .sidebar-toggle-wrapper {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                padding: 0.5rem 1rem;
                transition: all 0.3s ease;
            }

            /* Toggle text hidden in mini mode */
            .sidebar.mini .sidebar-toggle-wrapper .sidebar-text {
                display: none;
            }

            /* Center the toggle button in mini mode */
            .sidebar.mini .sidebar-toggle-wrapper button#sidebarToggle {
                margin-left: auto;
                margin-right: auto;
            }

            /* ===== Responsive Sidebar ===== */
            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                    z-index: 9999;
                    position: fixed;
                }
                .sidebar.sidebar-open {
                    transform: translateX(0);
                }
                .content-wrapper {
                    margin-left: 0 !important;
                }
            }

            /* ===== Buttons ===== */
            .btn {
                color: #fff;
                background-color: var(--primary);
                border-color: var(--primary);
                transition: all 0.2s ease;
            }
            .btn:hover {
                background-color: var(--primary);
                border-color: var(--primary-active);
            }
            .btn:active,
            .btn:active:focus {
                background-color: var(--primary-active);
            }
            .btn-outline-secondary {
                border-radius: 10px;
                padding: 6px 12px;
                border: 1px solid var(--primary);
                background: #ffffff;
                color: var(--primary);
                transition: all 0.25s ease;
                display: flex;
                align-items: center;
                gap: 5px;
            }
            .btn-outline-secondary:hover {
                background: var(--primary);
                color: #ffffff;
                border: 1px solid #fff;
                transform: translateY(-1px);
            }

            /* ===== Cards ===== */
            .card {
                border-radius: 10px;
                box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            }
            .card-header.bg-primary {
                background-color: var(--primary) !important;
                border-color: var(--primary);
            }

            /* ===== Form Fields ===== */
            .form-control:focus,
            .form-select:focus {
                border-color: var(--primary) !important;
                box-shadow: 0 0 0 0.15rem rgba(43, 75, 123, 0.35) !important;
            }
            .fieldcustom {
                border-radius: 3px;
                background: #ededed;
                box-shadow: inset 10px 10px 8px #dadada,
                            inset -10px -10px 8px #ffffff;
            }
            .fieldcustom.active {
                border-color: #28a745 !important; 
                box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            }

            /* ===== Dashboard Cards ===== */
            .icon-circle {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                margin: 0 auto 10px;
            }
            .hover-card:hover {
                transform: translateY(-5px);
                transition: 0.3s;
                box-shadow: 0 10px 20px rgba(0,0,0,0.12), 0 6px 6px rgba(0,0,0,0.08);
            }

            /* ===== Table Hover ===== */
            tr[style*="cursor:pointer"]:hover {
                background-color: #f8f9fa !important;
            }

            /* ===== Ticker Styles (Add Check Page) ===== */
            .ticker-wrap {
                width: 100%;
                overflow: hidden;
                position: relative;
                background: #f8f9fa;
                padding: 5px 0;
                border-radius: 8px;
            }
            .ticker {
                display: inline-block;
                white-space: nowrap;
                padding-left: 100%;
                animation: tickerMove 25s linear infinite;
            }
            .ticker-item {
                display: inline-block;
                margin-right: 3rem;
                font-size: 0.95rem;
            }
            @keyframes tickerMove {
                0% { transform: translateX(0); }
                100% { transform: translateX(-100%); }
            }

            /* ===== Watermark Button ===== */
            #watermarkBtn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 9999;
                opacity: 0.3;
                transition: all 0.3s ease;
                cursor: pointer;
            }
            #watermarkBtn img {
                width: 60px;
                height: auto;
                border-radius: 10px;
            }
            #watermarkBtn:hover {
                opacity: 1;
                transform: scale(1.1);
            }

            /* ===== Modals ===== */
            .modal-header {
                background-color: var(--primary) !important;
                color: #ffffff !important;
            }

            .modal-header .btn-close {
                filter: brightness(0) invert(1);
            }
        </style>

        
    </head>
        <body class="@auth has-sidebar @endauth">
            <div id="app">

                <!-- Navbar -->
                <nav class="navbar navbar-expand-md navbar-light sticky-top">
                    <div class="container-fluid">
                        
                        @if(Auth::user())
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset('icon/CHECKLOGO-Transparent.png') }}" alt="{{ config('app.name', 'Laravel') }}" 
                                    style="height:40px; width:auto; background-color: #fff; border-radius: 5px;">
                            </a>
                        @endif
                        <span class="sidebar-text" style="margin-right: 10px; font-weight: 600; color: #ffffff;">
                            Check Register System
                        </span>

                        @auth
                        @endauth
                        <ul class="navbar-nav ms-auto align-items-center">
                            @guest
                            @if(Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" style="color: #fff;" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right"></i> Login
                                </a>
                            </li>
                            @endif
                            {{-- @if(Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus"></i> Register
                                </a>
                            </li>
                            @endif --}}
                            
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center gap-2" style="color: #fff;" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0 mt-1">
                                    {{-- <a class="dropdown-item py-2" href="#"><i class="bi bi-gear"></i> Settings</a> --}}
                                    {{-- <div class="dropdown-divider"></div> --}}
                                    <a class="dropdown-item text-danger py-2" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </nav>

                <!-- Sidebar -->
                @auth
                    <!-- Sidebar -->
                    <div class="sidebar" id="sidebar">
                                                    
                    {{-- <div class="sidebar-toggle-wrapper mb-3">
                        <button class="btn btn-outline-secondary" id="sidebarToggle" style="width: 40px;">
                            <i class="bi bi-list"></i>
                        </button>
                    </div> --}}

                        <ul class="nav flex-column">
                            {{-- Dashboard --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('/admin') }}">
                                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                                </a>
                            </li>

                            {{-- Add Cheque --}}
                            @if(in_array(Auth::user()->user_type, ['admin', 'check-add']))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('add') ? 'active' : '' }}" href="{{ url('/add') }}">
                                    <i class="bi bi-plus-square"></i> <span>Add Cheque</span>
                                </a>
                            </li>
                            @endif

                            {{-- Cheque Added --}}
                            @if(in_array(Auth::user()->user_type, ['admin', 'check-release']))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('added') ? 'active' : '' }}" href="{{ url('/added') }}">
                                    <i class="bi bi-card-checklist"></i> <span>Cheque Added</span>
                                </a>
                            </li>
                            @endif

                            {{-- Generate Report --}}
                            @if(in_array(Auth::user()->user_type, ['admin', 'check-release', 'check-add']))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('checkadded/print') ? 'active' : '' }}" href="{{ url('/checkadded/print') }}">
                                    <i class="bi bi-file-earmark-text"></i> <span>Generate Report</span>
                                </a>
                            </li>
                            @endif

                            {{-- Admin Settings --}}
                            @if(Auth::user()->user_type === 'admin')
                            <li class="nav-item">
                                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->is('settings*') ? 'active' : '' }}" 
                                data-bs-toggle="collapse" 
                                href="#adminSettingsMenu" 
                                role="button" 
                                aria-expanded="{{ request()->is('settings*') ? 'true' : 'false' }}" 
                                aria-controls="adminSettingsMenu">
                                    <span><i class="bi bi-gear"></i> <span>Admin Settings</span></span>
                                    <i class="bi bi-chevron-down small"></i>
                                </a>

                                <div class="collapse {{ request()->is('settings*') ? 'show' : '' }}" id="adminSettingsMenu">
                                    <ul class="nav flex-column ms-3 border-start ps-2">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('settings/users') ? 'active' : '' }}" href="{{ url('settings/users') }}">
                                                <i class="bi bi-person"></i> <span>Manage Users</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                @endauth
                <!-- Page Content -->
                <main class="content-wrapper @guest content-full @endguest" id="contentWrapper">
                    @yield('content')
                </main>
            </div>

            <a href="https://github.com/kobeRaf" target="_blank" id="watermarkBtn">
                <img src="/icon/KOBEICON.png" alt="GitHub" />
            </a>

            <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
        </body>
</html>
