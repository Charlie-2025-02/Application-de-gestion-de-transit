@extends('layouts.app')

@section('content')
<div class="container py-5">
    <style>
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animated {
            opacity: 0;
            animation-fill-mode: forwards;
        }
        .fadeInUp {
            animation-name: fadeInUp;
            animation-duration: 9s;
            animation-delay: 0.2s;
        }

        .card-header.bg-primary {
            background: linear-gradient(to right, #007bff, #00ab4a);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h3 class="mb-0">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Finalisez la création de votre profil client
                    </h3>
                </div>

                <div class="text-center mt-4">
                    <p class="text-success fw-medium px-3 animated fadeInUp">
                        📝 Complétez les informations nécessaires pour accéder à votre tableau de bord
                        et gérer vos dossiers de transport.
                    </p>
                </div>

                <div class="card-body p-5">

                    @if ($errors->any())
                        <div class="alert alert-danger border-start border-4 border-danger">
                            <h5><i class="bi bi-exclamation-circle-fill me-2"></i> Erreurs détectées :</h5>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('clients.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-floating mb-4">
                            <input
                                type="text"
                                class="form-control rounded-3 shadow-sm @error('nom') is-invalid @enderror"
                                id="nom"
                                name="nom"
                                placeholder="Nom du client"
                                value="{{ old('nom') }}"
                                required
                            >
                            <label for="nom"><i class="bi bi-person-fill me-2"></i>Nom du client</label>
                            @error('nom')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input
                                type="text"
                                class="form-control rounded-3 shadow-sm @error('entreprise') is-invalid @enderror"
                                id="entreprise"
                                name="entreprise"
                                placeholder="Entreprise"
                                value="{{ old('entreprise') }}"
                            >
                            <label for="entreprise"><i class="bi bi-building me-2"></i>Entreprise (optionnel)</label>
                            @error('entreprise')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input
                                type="email"
                                class="form-control rounded-3 shadow-sm"
                                id="email"
                                name="email"
                                placeholder="Email"
                                value="{{ Auth::user()->email }}"
                                readonly
                            >
                            <label for="email"><i class="bi bi-envelope-at-fill me-2"></i>Email (lecture seule)</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input
                                type="tel"
                                class="form-control rounded-3 shadow-sm @error('telephone') is-invalid @enderror"
                                id="telephone"
                                name="telephone"
                                placeholder="Téléphone"
                                value="{{ old('telephone') }}"
                                pattern="[\d\s\-\+\(\)]*"
                            >
                            <label for="telephone"><i class="bi bi-telephone-fill me-2"></i>Numéro de téléphone</label>
                            @error('telephone')
                                <div class="invalid-feedback d-block">{{ $telephone:}} </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-5">
                            <input
                                type="text"
                                class="form-control rounded-3 shadow-sm @error('adresse') is-invalid @enderror"
                                id="adresse"
                                name="adresse"
                                placeholder="Adresse"
                                value="{{ old('adresse') }}"
                            >
                            <label for="adresse"><i class="bi bi-geo-alt-fill me-2"></i>Adresse complète</label>
                            @error('adresse')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center gap-4">
                            <button type="submit" class="btn btn-success px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                <i class="bi bi-check-circle me-2"></i>Enregistrer
                            </button>
                            <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                <i class="bi bi-x-circle me-2"></i>Annuler
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
