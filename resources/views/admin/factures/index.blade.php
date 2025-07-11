@extends('layouts.admin')

@section('title', 'Liste des factures')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-primary">
                    <i class="bi bi-file-earmark-text-fill me-2"></i> Liste des Factures
                </h3>
                <a href="{{ route('admin.factures.create') }}" class="btn btn-outline-primary shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Nouvelle facture
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>📄 Numéro</th>
                                    <th>👤 Client</th>
                                    <th>📁 Dossier</th>
                                    <th>📆 Date</th>
                                    <th>💰 HT</th>
                                    <th>🔢 TVA</th>
                                    <th>💵 TTC</th>
                                    <th>📌 Statut</th>
                                    <th>⚙️ Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse($factures as $facture)
                                    <tr>
                                        <td class="fw-semibold">{{ $facture->numero_facture }}</td>
                                        <td>{{ $facture->client->nom }}</td>
                                        <td>{{ $facture->dossier->titre }}</td>
                                        <td>{{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</td>
                                        <td class="text-success">{{ number_format($facture->montant_ht, 2, ',', ' ') }} FCFA</td>
                                        <td>{{ $facture->tva }}%</td>
                                        <td class="fw-bold text-dark">{{ number_format($facture->montant_ttc, 2, ',', ' ') }} FCFA</td>
                                        <td>
                                            @switch($facture->statut)
                                                @case('paye')
                                                    <span class="badge bg-success">Payé</span>
                                                    @break
                                                @case('en_attente')
                                                    <span class="badge bg-warning text-dark">En attente</span>
                                                    @break
                                                @case('annule')
                                                    <span class="badge bg-danger">Annulé</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">Inconnu</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('admin.factures.show', $facture) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('admin.factures.edit', $facture) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <a href="{{ route('admin.factures.download', $facture) }}"
                                                class="btn btn-sm btn-outline-success"
                                                title="Télécharger la facture">
                                                <i class="bi bi-download"></i>
                                                </a>

                                                <form action="{{ route('admin.factures.destroy', $facture->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cette facture ?')" title="Supprimer">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-muted py-4">
                                            <i class="bi bi-exclamation-triangle me-1"></i> Aucune facture trouvée.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class=" justify-content-between align-items-center py-3 px-4 bg-light rounded-bottom">

                        <div>
                            {{ $factures->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
