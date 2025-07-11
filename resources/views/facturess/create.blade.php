@extends('layouts.app')

@section('title', 'Nouvelle facture')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Créer une nouvelle facture</h1>

    <form method="POST" action="{{ route('factures.store') }}">
        @csrf

        <div class="mb-3">
            <label for="client_id">Client</label>
            <select name="client_id" class="form-control" required>
                <option value="">-- Sélectionner un client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="dossier_id">Dossier</label>
            <select name="dossier_id" class="form-control" required>
                <option value="">-- Sélectionner un dossier --</option>
                @foreach($dossiers as $dossier)
                    <option value="{{ $dossier->id }}">{{ $dossier->titre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_facture">Date de la facture</label>
            <input type="date" name="date_facture" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="montant_ht">Montant HT (FCFA)</label>
            <input type="number" name="montant_ht" class="form-control" step="0.01" min="0" required>
        </div>

        <div class="mb-3">
            <label for="statut">Statut</label>
            <select name="statut" class="form-control" required>
                <option value="en_attente">En attente</option>
                <option value="paye">Payé</option>
                <option value="annule">Annulé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer la facture</button>
    </form>
</div>
@endsection
