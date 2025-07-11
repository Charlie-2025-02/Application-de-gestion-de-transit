@extends('layouts.admin')

@section('title', 'Nouvelle facture')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-file-earmark-plus me-2"></i>Créer une nouvelle facture</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.factures.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="client_id" class="form-label">Client</label>
                            <select name="client_id" id="client_id" class="form-select" required>
                                <option value="">-- Sélectionner un client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="dossier_id" class="form-label">Dossier</label>
                            <select name="dossier_id" id="dossier_id" class="form-select" required disabled>
                                <option value="">-- Veuillez d’abord choisir un client --</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="date_facture" class="form-label">Date de la facture</label>
                            <input type="date" name="date_facture" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="montant_ht" class="form-label">Montant HT (FCFA)</label>
                            <input type="number" name="montant_ht" class="form-control" step="0.01" min="0" required>
                        </div>

                        <div class="mb-4">
                            <label for="statut" class="form-label">Statut</label>
                            <select name="statut" class="form-select" required>
                                <option value="en_attente">En attente</option>
                                <option value="paye">Payé</option>
                                <option value="annule">Annulé</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle me-1"></i> Enregistrer la facture
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const clientSelect = document.getElementById('client_id');
    const dossierSelect = document.getElementById('dossier_id');

    clientSelect.addEventListener('change', function () {
        const clientId = this.value;
        dossierSelect.innerHTML = '<option value="">Chargement...</option>';
        dossierSelect.disabled = true;

        if (clientId) {
            fetch(`/admin/clients/${clientId}/dossiers`)
                .then(res => res.json())
                .then(data => {
                    dossierSelect.innerHTML = '<option value="">-- Sélectionner un dossier --</option>';
                    if (data.length === 0) {
                        dossierSelect.innerHTML += '<option value="">Aucun dossier non terminé</option>';
                    } else {
                        data.forEach(dossier => {
                            dossierSelect.innerHTML += `<option value="${dossier.id}">${dossier.titre}</option>`;
                        });
                    }
                    dossierSelect.disabled = false;
                })
                .catch(() => {
                    dossierSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                });
        } else {
            dossierSelect.innerHTML = '<option value="">-- Veuillez d’abord choisir un client --</option>';
        }
    });
});
</script>
@endsection
