@extends('layouts.app')

@section('title', 'Détail de la facture')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Détails de la facture</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <h3>Numéro de facture : {{ $facture->numero_facture }}</h3>
            <p><strong>Client :</strong> {{ $facture->client->nom }}</p>
            <p><strong>Dossier :</strong> {{ $facture->dossier->titre }}</p>
            <p><strong>Date de la facture :</strong> {{ $facture->date_facture }}</p>
            <p><strong>Montant HT :</strong> {{ number_format($facture->montant_ht, 2) }} FCFA</p>
            <p><strong>TVA :</strong> {{ $facture->tva }} %</p>
            <p><strong>Montant TTC :</strong> {{ number_format($facture->montant_ttc, 2) }} FCFA</p>
            <p><strong>Statut :</strong> {{ ucfirst($facture->statut) }}</p>

            <a href="{{ route('factures.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
