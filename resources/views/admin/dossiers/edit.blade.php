@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-folder-check me-2"></i> Modifier le Dossier</h4>
            <a href="{{ route('admin.dossiers.index') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.dossiers.update', $dossier) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="titre" class="form-label fw-bold">Titre</label>
                    <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $dossier->titre) }}" required>
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="numero_dossier" class="form-label fw-bold">Référence du Dossier</label>
                    <input type="text" class="form-control @error('numero_dossier') is-invalid @enderror" id="numero_dossier" name="numero_dossier" value="{{ old('numero_dossier', $dossier->numero_dossier) }}" required>
                    @error('numero_dossier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="objet" class="form-label fw-bold">Objet du transport</label>
                    <input type="text" class="form-control @error('objet') is-invalid @enderror" id="objet" name="objet" value="{{ old('objet', $dossier->objet) }}" required>
                    @error('objet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="depart" class="form-label fw-bold">Lieu de départ</label>
                        <input type="text" class="form-control @error('depart') is-invalid @enderror" id="depart" name="depart" value="{{ old('depart', $dossier->depart) }}" required>
                        @error('depart')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="arrivee" class="form-label fw-bold">Lieu d’arrivée</label>
                        <input type="text" class="form-control @error('arrivee') is-invalid @enderror" id="arrivee" name="arrivee" value="{{ old('arrivee', $dossier->arrivee) }}" required>
                        @error('arrivee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_depart" class="form-label fw-bold">Date de départ</label>
                        <input type="date" class="form-control @error('date_depart') is-invalid @enderror" id="date_depart" name="date_depart" value="{{ old('date_depart', $dossier->date_depart ? $dossier->date_depart->format('Y-m-d') : '') }}" required>
                        @error('date_depart')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date_arrivee" class="form-label fw-bold">Date d’arrivée prévue</label>
                        <input type="date" class="form-control @error('date_arrivee') is-invalid @enderror" id="date_arrivee" name="date_arrivee" value="{{ old('date_arrivee', $dossier->date_arrivee ? $dossier->date_arrivee->format('Y-m-d') : '') }}" required>
                        @error('date_arrivee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="vehicule" class="form-label fw-bold">Véhicule</label>
                        <input type="text" class="form-control @error('vehicule') is-invalid @enderror" id="vehicule" name="vehicule" value="{{ old('vehicule', $dossier->vehicule) }}" required>
                        @error('vehicule')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="chauffeur" class="form-label fw-bold">Chauffeur</label>
                        <input type="text" class="form-control @error('chauffeur') is-invalid @enderror" id="chauffeur" name="chauffeur" value="{{ old('chauffeur', $dossier->chauffeur) }}" required>
                        @error('chauffeur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="type_transport" class="form-label fw-bold">Type de transport</label>
                    <select class="form-select @error('type_transport') is-invalid @enderror" id="type_transport" name="type_transport" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="terrestre" {{ old('type_transport', $dossier->type_transport) == 'terrestre' ? 'selected' : '' }}>Terrestre</option>
                        <option value="maritime" {{ old('type_transport', $dossier->type_transport) == 'maritime' ? 'selected' : '' }}>Maritime</option>
                        <option value="aerien" {{ old('type_transport', $dossier->type_transport) == 'aerien' ? 'selected' : '' }}>Aérien</option>
                    </select>
                    @error('type_transport')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="statut" class="form-label fw-bold">Statut</label>
                    <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="en_attente" {{ old('statut', $dossier->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en_cours" {{ old('statut', $dossier->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="termine" {{ old('statut', $dossier->statut) == 'termine' ? 'selected' : '' }}>Terminé</option>
                        <option value="annule" {{ old('statut', $dossier->statut) == 'annule' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="client_id" class="form-label fw-bold">Client associé</label>
                    <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                        <option value="">-- Sélectionner un client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $dossier->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="remarques" class="form-label fw-bold">Remarques</label>
                    <textarea class="form-control @error('remarques') is-invalid @enderror" id="remarques" name="remarques" rows="3">{{ old('remarques', $dossier->remarques) }}</textarea>
                    @error('remarques')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-check-circle-fill me-1"></i> Enregistrer
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
