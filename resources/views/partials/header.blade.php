<style>
    .navbar-nav .nav-link {
        color: white !important;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .navbar-nav .nav-link:hover {
        color: #f8f9fa !important;
    }

    .btn-auth {
        color: white !important;
        background-color: #28a745;
        font-weight: bold;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-blue shadow mb-4" style="background-color:#007bff">
    <div class="container-fluid">
        @php
            $currentRoute = Route::currentRouteName();
        @endphp

        @if($currentRoute === 'welcome')
            <div class="w-100 d-flex justify-content-center align-items-center text-center py-3">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('images/Image11.png') }}" alt="Logo TransGest" style="height: 150px;" class="me-3">
                    <span class="fs-4 fw-bold text-dark">Tableau de bord d'authentification des utilisateurs</span>
                </a>
            </div>
        @else
            <a class="navbar-brand fw-bold text-primary d-inline-block mb-3" href="#">
                <div style="
                    height: 100px;
                    width: 100px;
                    background-color: white;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 0 10px rgba(0,0,0,0.2);
                    margin: 0 auto;
                ">
                    <img src="{{ asset('images/Image11.png') }}" alt="Logo TransGest" style="height: 144px; width: auto; object-fit: contain; margin-left: -11px; margin-top: -5px;">
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTransGest" aria-controls="navbarTransGest" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTransGest">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        @php
                            $role = Auth::user()->role->name ?? null;
                        @endphp

                        @if($role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Tableau de bord admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.factures.index') }}">Gestion des factures</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Gestion des utilisateurs</a>
                            </li>
                        @elseif($role === 'client')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.dossiers.index') }}">
                                    <i class="bi bi-folder2-open me-2"></i> Mes Dossiers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.facturees') }}">
                                    <i class="bi bi-receipt me-2"></i> Mes Factures
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.paiements.index') }}">
                                    <i class="bi bi-credit-card me-2"></i> Mes Paiements
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.messages.index') }}">
                                    <i class="bi bi-chat-dots me-2"></i> Messagerie
                                </a>
                            </li>
                        @elseif ($role !== 'admin' && $role !== 'client')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('accueil') }}">
                                    <i class="bi bi-house-door me-1" ></i> Accueil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('apropos') }}">
                                    <i class="bi bi-info-circle-fill me-1"></i> À propos de TransGest
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('welcome') }}" class="btn btn-auth ms-3">
                                    <i class="bi bi-shield-lock-fill me-1"></i> Authentifiez-vous
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <div class="d-flex align-items-center">
                    @auth
                        <span class="me-3">
                            Bienvenue, <strong style="color:white">{{ Auth::user()->name }}</strong>
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-auth">Déconnexion</button>
                        </form>
                    @endauth
                </div>
            </div>
        @endif
    </div>
</nav>
