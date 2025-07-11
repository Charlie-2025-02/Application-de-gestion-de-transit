@extends('layouts.app')

@section('title', 'Liste des factures')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Liste des factures</h1>

    <a href="{{ route('factures.create') }}" class="btn btn-primary mb-3">Nouvelle facture</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Client</th>
                <th>Dossier</th>
                <th>Date</th>
                <th>Montant HT</th>
                <th>TVA (%)</th>
                <th>Montant TTC</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factures as $facture)
            <tr>
                <td>{{ $facture->numero_facture }}</td>
                <td>{{ $facture->client->nom }}</td>
                <td>{{ $facture->dossier->titre }}</td>
                <td>{{ $facture->date_facture }}</td>
                <td>{{ number_format($facture->montant_ht, 2) }} FCFA</td>
                <td>{{ $facture->tva }}%</td>
                <td>{{ number_format($facture->montant_ttc, 2) }} FCFA</td>
                <td>{{ ucfirst($facture->statut) }}</td>
                <td><a href="{{ route('factures.show', $facture) }}" class="btn btn-sm btn-outline-primary">Voir</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
