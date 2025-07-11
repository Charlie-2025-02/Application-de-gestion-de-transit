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

    .btn-auth:hover {
        background-color: #218838;
    }

    .navbar-brand span {
        color: white;
        font-size: 1.3rem;
        font-weight: bold;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light shadow-sm mb-4" style="background-color:#007bff">
    <div class="container-fluid">

        @php
            $currentRoute = Route::currentRouteName();
        @endphp

        @if(in_array($currentRoute, ['auth.login', 'auth.register']))
            <div class="w-100 d-flex flex-column justify-content-center align-items-center text-center py-4">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('images/Image11.png') }}" alt="Logo TransGest" style="height: 100px;" class="me-3">
                    <span class="fs-4 fw-bold text-white">Tableau de bord d'inscription et de connexion</span>
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('accueil') }}">
                            <i class="bi bi-house-door me-1"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('apropos') }}">
                            <i class="bi bi-info-circle-fill me-1"></i> À propos de TransGest
                        </a>
                    </li>
                </ul>

                <div class="d-flex">
                    <a href="{{ route('auth.login') }}" class="btn btn-auth me-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                    </a>
                    <a href="{{ route('auth.register') }}" class="btn btn-auth">
                        <i class="bi bi-person-plus-fill me-1"></i> Inscription
                    </a>
                </div>
            </div>
        @endif

    </div>
</nav>
