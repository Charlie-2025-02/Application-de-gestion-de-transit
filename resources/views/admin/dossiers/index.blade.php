@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📂 Tous les Dossiers</h4>
            <a href="{{ route('admin.dossiers.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Nouveau Dossier
            </a>
        </div>

        <div class="card-body">
            @if ($dossiers->isEmpty())
                <div class="alert alert-info text-center">Aucun dossier trouvé.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#ID - N° Dossier</th>
                                <th>Référence</th>
                                <th>Objet</th>
                                <th>Type de Transport</th>
                                <th>Client</th>
                                <th>Statut</th>
                                <th>Départ</th>
                                <th>Arrivée</th>
                                <th>Véhicule</th>
                                <th>Chauffeur</th>
                                <th>Créé le</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dossiers as $dossier)
                                <tr>
                                    <td>{{ $dossier->id }}  — {{ $dossier->numero_dossier }}</td>
                                    <td>{{ $dossier->titre }}</td>
                                    <td>{{ $dossier->objet }}</td>
                                    <td>{{ Str::limit($dossier->type_transport, 30) }}</td>
                                    <td>{{ $dossier->client->nom ?? 'Client supprimé' }}</td>
                                    <td>
                                        @if($dossier->statut === 'en_cours')
                                            <span class="badge bg-success">En Cours</span>
                                        @elseif($dossier->statut === 'en_attente')
                                            <span class="badge bg-success">En Attente</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($dossier->statut) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $dossier->date_depart ? \Carbon\Carbon::parse($dossier->date_depart)->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $dossier->date_arrivee ? \Carbon\Carbon::parse($dossier->date_arrivee)->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $dossier->vehicule }}</td>
                                    <td>{{ $dossier->chauffeur }}</td>
                                    <td>{{ $dossier->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.dossiers.show', $dossier) }}" class="btn btn-sm btn-outline-info me-1" title="Voir les détails">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <form action="{{ route('admin.dossiers.delete', $dossier) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer"
                                                onclick="return confirm('Voulez-vous vraiment supprimer ce dossier ?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4  py-3 px-5 bg-light rounded" style="color: black">
                    {{ $dossiers->links('pagination::bootstrap-5') }}
                </div>

            @endif
        </div>
    </div>
</div>
@endsection
