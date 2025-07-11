@extends('layouts.app')

@section('title', 'Tableau de bord client')

@section('content')
<div class="container mt-5">

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-center mb-5">
        <p><h2 class="lead text-dark">Voici votre tableau de bord <strong class="text-primary">TransGest</strong>.</h2></p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-primary text-white text-center h-100">
                <div class="card-body">
                    <h5 class="card-title">Dossiers en cours</h5>
                    <p class="display-4 fw-bold">{{ $dossiersEnCours }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-dark text-white text-center h-100">
                <div class="card-body">
                    <h5 class="card-title">Total dossiers</h5>
                    <p class="display-4 fw-bold">{{ $dossiers->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-success text-white text-center h-100 d-flex justify-content-center">
                <div class="card-body">
                    <h5 class="card-title">Créer un dossier</h5>
                    <a href="{{ route('clients.dossiers.create', ['client' => $client->id]) }}" class="btn btn-light mt-3">
                        <i class="bi bi-plus-circle me-1"></i> Nouveau dossier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-light">
            <h4 class="mb-0 text-dark">Derniers dossiers</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-striped table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-uppercase">Référence</th>
                            <th scope="col" class="text-uppercase">Numéro</th>
                            <th scope="col" class="text-uppercase">Date</th>
                            <th scope="col" class="text-uppercase">Statut</th>
                            <th scope="col" class="text-uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dossiers as $dossier)
                            <tr>
                                <td class="fw-semibold text-start">{{ $dossier->titre }}</td>
                                <td>{{ $dossier->numero_dossier }}</td>
                                <td>{{ $dossier->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @switch($dossier->statut)
                                        @case('en_attente')
                                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">En attente</span>
                                            @break
                                        @case('en_cours')
                                            <span class="badge bg-primary px-3 py-2 rounded-pill">En cours</span>
                                            @break
                                        @case('terminé')
                                            <span class="badge bg-success px-3 py-2 rounded-pill">Terminé</span>
                                            @break
                                        @case('annulé')
                                            <span class="badge bg-danger px-3 py-2 rounded-pill">Annulé</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary px-3 py-2 rounded-pill">Inconnu</span>
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('client.dossiers.show', $dossier->id) }}"
                                       class="btn btn-outline-info btn-sm me-1 mb-1"
                                       title="Voir le dossier">
                                        <i class="bi bi-eye"></i> Voir
                                    </a>

                                    @if($dossier->factures->isNotEmpty())
                                        @foreach($dossier->factures as $facture)
                                            <a href="{{ route('facturees.pdf', $facture) }}"
                                               class="btn btn-success btn-sm mb-1" title="Télécharger la facture PDF">
                                               <i class="bi bi-download"></i> PDF
                                            </a>
                                        @endforeach
                                    @else
                                        <span class="badge bg-light text-muted">Pas de facture</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Aucun dossier trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
