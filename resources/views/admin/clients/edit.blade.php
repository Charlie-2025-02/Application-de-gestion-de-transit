@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i> Modifier le Client
            </h4>
            <a href="{{ route('admin.clients.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.clients.update', $client) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label fw-semibold">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $client->nom) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $client->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="entreprise" class="form-label fw-semibold">Entreprise</label>
                    <input type="text" class="form-control" id="entreprise" name="entreprise" value="{{ old('entreprise', $client->entreprise) }}">
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                    <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $client->telephone) }}">
                </div>

                <div class="mb-3">
                    <label for="adresse" class="form-label fw-semibold">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $client->adresse) }}">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-check-circle-fill me-1"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
