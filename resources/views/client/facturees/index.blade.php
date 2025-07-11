@extends('layouts.app')

<style>
            th { background-color: #007bff; color: #fff; }

</style>
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Mes Factures</h3>
        </div>
        <div class="card-body">
            @if($factures->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle-fill me-2"></i> Aucune facture disponible.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>N° Facture</th>
                                <th>N° Dossier</th>
                                <th>Référence</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Montant TTC</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factures as $facture)
                                <tr>
                                    <td>{{ $facture->numero_facture }}</td>
                                    <td>{{ $facture->dossier->numero_dossier }}</td>
                                    <td>{{ $facture->dossier->titre }}</td>
                                    <td>
                                        @php
                                            $statut = $facture->statut;
                                            $class = match($statut) {
                                                'paye' => 'bg-success',
                                                'en_attente' => 'bg-warning text-dark',
                                                'annulé' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $class }}" style="font-size: 16px;">
                                            {{ ucfirst($statut) }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</td>
                                    <td>{{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        <a href="{{ route('pdf.facture', $facture) }}" class="btn btn-outline-success btn-sm">
                                            <i class="bi bi-download"></i> Télécharger PDF
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
