@extends('layouts.app')

@section('title', 'Mes dossiers')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Mes Dossiers</h3>
        </div>

        <div class="card-body">
            @if($dossiers->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle-fill me-2"></i> Aucun dossier trouvé.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Numéro Dossier</th>
                                <th>Objet</th>
                                <th>Départ</th>
                                <th>Arrivée</th>
                                <th>Type Transport</th>
                                <th>Date Départ</th>
                                <th>Date Arrivée</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dossiers as $dossier)
                                <tr>
                                    <td>{{ $dossier->numero_dossier }}</td>
                                    <td>{{ $dossier->objet }}</td>
                                    <td>{{ $dossier->depart }}</td>
                                    <td>{{ $dossier->arrivee }}</td>
                                    <td>{{ ucfirst($dossier->type_transport) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($dossier->date_depart)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($dossier->date_arrivee)->format('d/m/Y') }}</td>
                                    <td>
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
                                    </td>
                                    <td>
                                        <a href="{{ route('client.dossiers.show', $dossier->id) }}" class="btn btn-outline-info btn-sm">
                                            <i class="bi bi-eye"></i> Voir
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
