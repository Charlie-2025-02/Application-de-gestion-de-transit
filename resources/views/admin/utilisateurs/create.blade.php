@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-person-plus-fill me-2"></i> Ajouter un Utilisateur
            </h4>
            <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.utilisateurs.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <div class="invalid-feedback">Veuillez entrer le nom.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label fw-semibold">Rôle</label>
                    <select class="form-select" name="role_id" id="role_id" required>
                        <option value="">-- Sélectionnez un rôle --</option>
                        <option value="1">Admin</option>
                        <option value="2">Client</option>
                    </select>
                    <div class="invalid-feedback">Veuillez sélectionner un rôle.</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="invalid-feedback">Veuillez entrer un mot de passe.</div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    <div class="invalid-feedback">Veuillez confirmer le mot de passe.</div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-check-circle-fill me-1"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Annuler
                    </a>
                </div>
            </form>
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
