@extends('layouts.admin')

@section('title', 'Dossier ' . $dossier->numero_dossier)

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">
            <i class="bi bi-folder2-open me-2"></i> Dossier : {{ $dossier->titre }}
        </h3>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Retour au tableau de bord
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Détails du dossier</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <p class="mb-2"><strong class="text-muted">Numéro :</strong> {{ $dossier->numero_dossier }}</p>
                    <p class="mb-2"><strong class="text-muted">Client :</strong> {{ $dossier->client->nom ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-2">
                        <strong class="text-muted">Statut :</strong>
                        @if($dossier->statut === 'clôturé')
                            <span class="badge bg-success">Clôturé</span>
                        @elseif($dossier->statut === 'en cours')
                            <span class="badge bg-warning text-dark">En cours</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($dossier->statut) }}</span>
                        @endif
                    </p>
                    <p class="mb-2">
                        <strong class="text-muted">Date de création :</strong> {{ $dossier->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
            <hr>
            <p class="mb-0">
                <strong class="text-muted">Description :</strong><br>
                <div class="border p-3 rounded bg-light mt-2">
                    {{ $dossier->description ?: 'Aucune description disponible.' }}
                </div>
            </p>
        </div>
    </div>

    <div class="text-end">
        <a href="{{ route('admin.dossiers.edit', $dossier) }}" class="btn btn-primary me-2">
            <i class="bi bi-pencil-square me-1"></i> Modifier
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-house-door-fill me-1"></i> Retour
        </a>
    </div>

</div>
@endsection
