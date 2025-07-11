@extends('layouts.admin')

@section('title', 'Détail de la facture')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-receipt me-2"></i> Détails de la facture
                    </h4>
                </div>

                <div class="card-body">

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Numéro de facture :</strong>
                            <span class="fw-semibold">{{ $facture->numero_facture }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Client :</strong>
                            <span>{{ $facture->client->nom }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Référence du Dossier :</strong>
                            <span>{{ $facture->dossier->titre }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Numéro du Dossier :</strong>
                            <span>{{ $facture->dossier->numero_dossier }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Date de la facture :</strong>
                            <span>{{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Montant HT :</strong>
                            <span>{{ number_format($facture->montant_ht, 2) }} FCFA</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>TVA :</strong>
                            <span>{{ $facture->tva }} %</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Montant TTC :</strong>
                            <span class="text-success fw-bold">{{ number_format($facture->montant_ttc, 2) }} FCFA</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Statut :</strong>
                            <span>
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
                            </span>
                        </li>
                    </ul>

                    <div class="text-end">
                        <a href="{{ route('admin.factures.index') }}" class="btn btn-outline-success">
                            <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
