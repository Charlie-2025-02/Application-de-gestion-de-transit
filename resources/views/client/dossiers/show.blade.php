@extends('layouts.app')

@section('title', 'Dossier ' . $dossier->numero_dossier)

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Dossier n° {{ $dossier->numero_dossier }}</h3>
            <a href="{{ route('client.dossiers.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Client :</strong> {{ $dossier->client->nom ?? 'Non défini' }}</p>
                    <p><strong>Objet :</strong> {{ $dossier->objet }}</p>
                    <p><strong>Type de transport :</strong> {{ ucfirst($dossier->type_transport) }}</p>
                    <p><strong>Départ :</strong> {{ $dossier->depart }}</p>
                    <p><strong>Arrivée :</strong> {{ $dossier->arrivee }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Date de départ :</strong> {{ \Carbon\Carbon::parse($dossier->date_depart)->format('d/m/Y') }}</p>
                    <p><strong>Date d’arrivée prévue :</strong> {{ \Carbon\Carbon::parse($dossier->date_arrivee)->format('d/m/Y') }}</p>
                    <p><strong>Véhicule :</strong> {{ $dossier->vehicule }}</p>
                    <p><strong>Chauffeur :</strong> {{ $dossier->chauffeur }}</p>
                    <p><strong>Référence :</strong> {{ $dossier->titre }}</p>
                    <p><strong>Statut :</strong>
                        @switch($dossier->statut)
                            @case('en_attente')
                                <span class="badge bg-warning text-dark">En attente</span>
                                @break
                            @case('en_cours')
                                <span class="badge bg-primary">En cours</span>
                                @break
                            @case('terminé')
                                <span class="badge bg-success">Terminé</span>
                                @break
                            @case('annulé')
                                <span class="badge bg-danger">Annulé</span>
                                @break
                            @default
                                <span class="badge bg-secondary">Inconnu</span>
                        @endswitch
                    </p>
                </div>
            </div>

            <div class="mb-3">
                <p><strong>Remarques :</strong> {{ $dossier->remarques ?? 'Aucune' }}</p>
            </div>

            <div class="text-muted small">
                <p><strong>Créé le :</strong> {{ $dossier->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Mis à jour le :</strong> {{ $dossier->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
