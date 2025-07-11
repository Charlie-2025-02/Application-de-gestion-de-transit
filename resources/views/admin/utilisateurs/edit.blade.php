@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-person-lines-fill me-2"></i> Modifier l'Utilisateur
            </h4>
            <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.utilisateurs.update', $user) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    <div class="invalid-feedback">Le nom est requis.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    <div class="invalid-feedback">L’adresse email est requise.</div>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label fw-semibold">Rôle</label>
                    <select class="form-select" name="role" id="role" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                    <div class="invalid-feedback">Veuillez sélectionner un rôle.</div>
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
