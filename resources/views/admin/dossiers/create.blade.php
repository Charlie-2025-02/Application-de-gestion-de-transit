@extends('layouts.admin')

@section('title', 'Créer un dossier - Admin TransGest')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-folder-plus me-2"></i> Création d’un nouveau dossier de transport
        </h2>
        <a href="{{ route('admin.dossiers.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.dossiers.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control @error('titre') is-invalid @enderror"
                               id="titre" name="titre" value="{{ old('titre') }}" required>
                        @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="numero_dossier" class="form-label">Numéro de dossier</label>
                        <input type="text" class="form-control @error('numero_dossier') is-invalid @enderror"
                               id="numero_dossier" name="numero_dossier" value="{{ old('numero_dossier') }}" required>
                        @error('numero_dossier') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="objet" class="form-label">Objet du transport</label>
                    <input type="text" class="form-control @error('objet') is-invalid @enderror"
                           id="objet" name="objet" value="{{ old('objet') }}" required>
                    @error('objet') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="depart" class="form-label">Lieu de départ</label>
                        <input type="text" class="form-control @error('depart') is-invalid @enderror"
                               id="depart" name="depart" value="{{ old('depart') }}" required>
                        @error('depart') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="arrivee" class="form-label">Lieu d’arrivée</label>
                        <input type="text" class="form-control @error('arrivee') is-invalid @enderror"
                               id="arrivee" name="arrivee" value="{{ old('arrivee') }}" required>
                        @error('arrivee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_depart" class="form-label">Date de départ</label>
                        <input type="date" class="form-control @error('date_depart') is-invalid @enderror"
                               id="date_depart" name="date_depart" value="{{ old('date_depart') }}" required>
                        @error('date_depart') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date_arrivee" class="form-label">Date d’arrivée prévue</label>
                        <input type="date" class="form-control @error('date_arrivee') is-invalid @enderror"
                               id="date_arrivee" name="date_arrivee" value="{{ old('date_arrivee') }}" required>
                        @error('date_arrivee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="vehicule" class="form-label">Véhicule</label>
                        <input type="text" class="form-control @error('vehicule') is-invalid @enderror"
                               id="vehicule" name="vehicule" value="{{ old('vehicule') }}" required>
                        @error('vehicule') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="chauffeur" class="form-label">Chauffeur</label>
                        <input type="text" class="form-control @error('chauffeur') is-invalid @enderror"
                               id="chauffeur" name="chauffeur" value="{{ old('chauffeur') }}" required>
                        @error('chauffeur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="type_transport" class="form-label">Type de transport</label>
                    <select class="form-select @error('type_transport') is-invalid @enderror"
                            id="type_transport" name="type_transport" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="terrestre" {{ old('type_transport') == 'terrestre' ? 'selected' : '' }}>Terrestre</option>
                        <option value="maritime" {{ old('type_transport') == 'maritime' ? 'selected' : '' }}>Maritime</option>
                        <option value="aerien" {{ old('type_transport') == 'aerien' ? 'selected' : '' }}>Aérien</option>
                    </select>
                    @error('type_transport') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-select @error('statut') is-invalid @enderror"
                            id="statut" name="statut" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="termine" {{ old('statut') == 'termine' ? 'selected' : '' }}>Terminé</option>
                        <option value="annule" {{ old('statut') == 'annule' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="user_id" class="form-label">Client associé</label>

                    <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                        <option value="">-- Choisir un client existant --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->nom }} ({{ $client->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('client_id') <div class="invalid-feedback">{{ $message }}</div> @enderror

                </div>

                <div class="mb-3">
                    <label for="remarques" class="form-label">Remarques</label>
                    <textarea class="form-control @error('remarques') is-invalid @enderror"
                              id="remarques" name="remarques" rows="3">{{ old('remarques') }}</textarea>
                    @error('remarques') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-check-circle-fill me-1"></i> Créer le dossier
                    </button>
                    <a href="{{ route('admin.dossiers.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
