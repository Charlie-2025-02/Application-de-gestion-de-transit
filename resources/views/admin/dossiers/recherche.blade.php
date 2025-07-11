@extends('layouts.admin')

@section('title', 'Résultat de recherche')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-search"></i> Résultats de recherche
        </h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Retour au tableau de bord
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($dossiers->isEmpty())
                <div class="alert alert-warning text-center">
                    <i class="bi bi-exclamation-triangle"></i> Aucun dossier trouvé pour ces critères.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Numéro</th>
                                <th>Titre</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dossiers as $dossier)
                                <tr>
                                    <td>{{ $dossier->numero_dossier }}</td>
                                    <td>{{ $dossier->titre }}</td>
                                    <td>{{ $dossier->client->nom ?? '-' }}</td>
                                    <td>{{ $dossier->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <span class="badge px-3 py-2
                                            @if($dossier->statut === 'en_attente') bg-warning text-dark
                                            @elseif($dossier->statut === 'en_cours') bg-primary
                                            @else bg-success
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.dossiers.show', $dossier) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-folder2-open"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
