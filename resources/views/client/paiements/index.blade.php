@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-credit-card-2-back-fill me-2"></i> Mes Paiements
        </h2>
        <a href="{{ route('client.paiements.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Nouveau Paiement
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="bi bi-table me-1"></i> Liste des paiements enregistrés
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>Client</th>
                        <th>Facture</th>
                        <th>Dossier lié</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($paiements as $paiement)
                        <tr>
                            <td>{{ $paiement->client->nom ?? Auth::user()->name ?? 'Inconnu' }}</td>
                            <td>
                                <span class="fw-semibold">#{{ $paiement->facture_id }}</span><br>
                                <small class="text-muted">{{ $paiement->facture->numero_facture ?? 'N/A' }}</small>
                            </td>
                            <td>{{ $paiement->facture->dossier->numero_dossier ?? 'N/A' }}</td>
                            <td class="fw-bold text-success">
                                {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA
                            </td>
                            <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</td>
                            <td>
                                @php
                                    $statut = $paiement->statut ?? 'N/A';
                                @endphp
                                <span class="badge rounded-pill px-3 py-2 fs-6
                                    @if($statut === 'terminé') bg-success
                                    @elseif($statut === 'en_attente') bg-warning text-dark
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($statut) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted py-4 text-center">
                                <i class="bi bi-exclamation-circle-fill me-1"></i> Aucun paiement trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
