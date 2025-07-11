@extends('layouts.app')

@section('title', 'Créer un nouveau dossier')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Créer un nouveau dossier de transport</h4>
                    </div>

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

                        <form method="POST" action="{{ route('client.dossiers.store', ['client' => $client->id]) }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="titre" class="form-label">Titre</label>
                                    <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre') }}" required>
                                    @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="numero_dossier" class="form-label">Numéro de dossier</label>
                                    <input type="text" class="form-control @error('numero_dossier') is-invalid @enderror" id="numero_dossier" name="numero_dossier" value="{{ old('numero_dossier') }}" required>
                                    @error('numero_dossier') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="objet" class="form-label">Objet du transport</label>
                                <input type="text" class="form-control @error('objet') is-invalid @enderror" id="objet" name="objet" value="{{ old('objet') }}" required>
                                @error('objet') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="depart" class="form-label">Lieu de départ</label>
                                    <input type="text" class="form-control @error('depart') is-invalid @enderror" id="depart" name="depart" value="{{ old('depart') }}" required>
                                    @error('depart') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="arrivee" class="form-label">Lieu d’arrivée</label>
                                    <input type="text" class="form-control @error('arrivee') is-invalid @enderror" id="arrivee" name="arrivee" value="{{ old('arrivee') }}" required>
                                    @error('arrivee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date_depart" class="form-label">Date de départ</label>
                                    <input type="date" class="form-control @error('date_depart') is-invalid @enderror" id="date_depart" name="date_depart" value="{{ old('date_depart') }}" required>
                                    @error('date_depart') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="date_arrivee" class="form-label">Date d’arrivée prévue</label>
                                    <input type="date" class="form-control @error('date_arrivee') is-invalid @enderror" id="date_arrivee" name="date_arrivee" value="{{ old('date_arrivee') }}" required>
                                    @error('date_arrivee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehicule" class="form-label">Véhicule</label>
                                    <input type="text" class="form-control @error('vehicule') is-invalid @enderror" id="vehicule" name="vehicule" value="{{ old('vehicule') }}" required>
                                    @error('vehicule') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="chauffeur" class="form-label">Chauffeur</label>
                                    <input type="text" class="form-control @error('chauffeur') is-invalid @enderror" id="chauffeur" name="chauffeur" value="{{ old('chauffeur') }}" required>
                                    @error('chauffeur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="type_transport" class="form-label">Type de transport</label>
                                <select class="form-select @error('type_transport') is-invalid @enderror" id="type_transport" name="type_transport" required>
                                    <option value="">-- Sélectionner --</option>
                                    <option value="terrestre" {{ old('type_transport') == 'terrestre' ? 'selected' : '' }}>Terrestre</option>
                                    <option value="maritime" {{ old('type_transport') == 'maritime' ? 'selected' : '' }}>Maritime</option>
                                    <option value="aerien" {{ old('type_transport') == 'aerien' ? 'selected' : '' }}>Aérien</option>
                                </select>
                                @error('type_transport') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="statut" class="form-label">Statut</label>
                                <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                                    <option value="">-- Sélectionner --</option>
                                    <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="annule" {{ old('statut') == 'annulé' ? 'selected' : '' }}>Annulé</option>
                                </select>
                                @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="remarques" class="form-label">Remarques</label>
                                <textarea class="form-control @error('remarques') is-invalid @enderror" id="remarques" name="remarques" rows="3">{{ old('remarques') }}</textarea>
                                @error('remarques') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('client.dossiers.index', ['client' => $client->id]) }}" class="btn btn-secondary">Retour</a>
                                <button type="submit" class="btn btn-primary">Créer le dossier</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
