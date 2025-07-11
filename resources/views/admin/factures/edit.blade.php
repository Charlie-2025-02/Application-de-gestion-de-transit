@extends('layouts.admin')

@section('title', 'Modifier Facture')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-receipt-cutoff me-2"></i> Modifier la Facture
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.factures.update', $facture) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="numero" class="form-label">📄 Numéro de facture</label>
                            <input type="text" class="form-control" id="numero" name="numero"
                                   value="{{ $facture->numero }}" required>
                            <div class="invalid-feedback">
                                Veuillez entrer le numéro de la facture.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="client_id" class="form-label">👤 Client</label>
                            <select class="form-select" name="client_id" id="client_id" required>
                                <option disabled value="">Sélectionner un client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ $facture->client_id == $client->id ? 'selected' : '' }}>
                                        {{ $client->nom }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Veuillez choisir un client.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="montant" class="form-label">💰 Montant (en FCFA)</label>
                            <input type="number" class="form-control" id="montant" name="montant"
                                   value="{{ $facture->montant }}" required min="0" step="0.01">
                            <div class="invalid-feedback">
                                Veuillez entrer un montant valide.
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.factures.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save2"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection
