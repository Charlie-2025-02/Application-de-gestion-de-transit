@extends('layouts.app')

@section('title', 'Effectuer un paiement')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Effectuer un paiement</h3>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('client.paiements.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="facture_id" class="form-label">Facture à payer <span class="text-danger">*</span></label>
                    <select name="facture_id" id="facture_id" class="form-select" required>
                        <option value="">-- Choisir une facture --</option>
                        @foreach($factures as $facture)
                            <option value="{{ $facture->id }}" data-montant="{{ $facture->montant_ttc }}">
                                {{ $facture->numero_facture }} - {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }} - {{ number_format($facture->montant_ttc, 2, ',', ' ') }} FCFA
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="montant" class="form-label">Montant à payer (FCFA)</label>
                    <input type="text" id="montant" name="montant" class="form-control bg-light" readonly required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Moyen de paiement <span class="text-danger">*</span></label>
                    <select name="moyen_paiement" id="moyen_paiement" class="form-select" required>
                        <option value="">-- Choisir un moyen --</option>
                        <option value="carte">Carte Bancaire</option>
                        <option value="mobilemoney">Mobile Money</option>
                    </select>
                </div>

                <div id="carte-section" class="border rounded p-3 bg-light d-none">
                    <h5 class="text-primary">Détails Carte Bancaire</h5>
                    <div class="mb-3">
                        <label for="nom_titulaire" class="form-label">Nom du titulaire</label>
                        <input type="text" name="nom_titulaire" id="nom_titulaire" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="numero_carte" class="form-label">Numéro de carte</label>
                        <input type="text" name="numero_carte" id="numero_carte" class="form-control" maxlength="20">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" name="cvv" id="cvv" class="form-control" maxlength="4">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="expiration" class="form-label">Date d'expiration (MM/AA)</label>
                            <input type="text" name="expiration" id="expiration" class="form-control" placeholder="MM/AA">
                        </div>
                    </div>
                </div>

                <div class="mb-3 mt-4">
                    <label for="date_paiement" class="form-label">Date du paiement</label>
                    <input type="date" name="date_paiement" id="date_paiement" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-wallet2 me-1"></i> Payer maintenant
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const factureSelect = document.getElementById('facture_id');
        const montantInput = document.getElementById('montant');
        const moyenPaiement = document.getElementById('moyen_paiement');
        const carteSection = document.getElementById('carte-section');
        const momoSection = document.getElementById('mobilemoney-section');

        factureSelect.addEventListener('change', () => {
            const selected = factureSelect.options[factureSelect.selectedIndex];
            montantInput.value = selected.getAttribute('data-montant') || '';
        });

        moyenPaiement.addEventListener('change', function () {
            carteSection.classList.add('d-none');
            momoSection.classList.add('d-none');

            if (this.value === 'carte') {
                carteSection.classList.remove('d-none');
            } else if (this.value === 'mobilemoney') {
                momoSection.classList.remove('d-none');
            }
        });
    });
</script>
@endsection
