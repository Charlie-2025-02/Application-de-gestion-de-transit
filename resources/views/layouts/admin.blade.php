<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title') - Admin | TransGest</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

        <style>
            body, html {
                height: 100%;
                margin: 0;
            }

            .sidebar {
                width: 240px;
                background-color: #007bff;
                color: white;
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                padding: 1rem;
                display: flex;
                flex-direction: column;
            }

            .sidebar .nav-link {
                color: #fff;
                border-radius: 0.375rem;
                padding: 0.5rem 0.75rem;
                transition: all 0.2s ease-in-out;
            }

            .sidebar .nav-link.active,
            .sidebar .nav-link:hover {
                background-color: #343a40;
                color: #fff;
            }

            .main-content {
                margin-left: 240px;
                min-height: 100vh;
                background-color: #f8f9fa;
                padding: 2rem;
            }

            .sidebar .navbar-brand h6 {
                color: #0d6efd;
                font-weight: bold;
                margin-top: 0.5rem;
            }

            .sidebar form button {
                margin-top: 1rem;
            }
        </style>

        <style>
            .chart-container {
                position: relative;
                width: 100%;
                overflow-x: auto;
            }
        </style>

    </head>

    @yield('scripts')

    <body>

        <nav class="sidebar">

            @php
                $currentRoute = Route::currentRouteName();
            @endphp

            <a class="navbar-brand fw-bold text-primary mb-4" href="#" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: inherit;">
                <div style="
                    height: 150px;
                    width: 150px;
                    background-color: white;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                    box-shadow: 0 0 10px rgba(0,0,0,0.2);
                    margin: 0 auto;
                ">
                    <img src="{{ asset('images/Image11.png') }}" alt="Logo TransGest" style="height: 213px; width: auto; object-fit: contain; margin-left: -15px; margin-top: 45px;">
                    <h6 class="text-center mb-4">TransGest Admin</h6>
                </div>
            </a>

            <div class="my-4"></div>

            <ul class="nav nav-pills flex-column mb-4">
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-house me-2"></i> Tableau de bord
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.utilisateurs.index') }}" class="nav-link {{ request()->routeIs('admin.utilisateurs.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Gérer les utilisateurs
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Gérer les Clients
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.dossiers.index') }}" class="nav-link {{ request()->routeIs('admin.dossiers.*') ? 'active' : '' }}">
                        <i class="bi bi-folder me-2"></i> Gérer les Dossiers
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.factures.index') }}" class="nav-link {{ request()->routeIs('admin.factures.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text me-2"></i> Gérer les Factures
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope me-2"></i> Voire la Messagerie
                    </a>
                </li>
            </ul>

            <div class="mt-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-grid">
                    @csrf
                    <button class="btn text-white" style="background-color: #00ab4a">
                        <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                    </button>
                </form>

                <div class="text-center small text-white mt-3">
                    Connecté en tant que <br>
                    <strong>{{ Auth::user()?->name ?? 'Admin' }}</strong>
                </div>
            </div>

        </nav>

        <div class="main-content">
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
