@extends('layouts.admin')

@section('title', 'Dashboard Admin - TransGest')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold mb-2">Dashboard Administrateur</h1>
        <span class="badge text-white fs-6 py-2 px-4 rounded-pill shadow-sm" style="background-color: #007bff">
            👋 Bienvenue, {{ Auth::user()->name ?? 'Admin' }}
        </span>
    </div>

    <div class="card border-0 shadow mb-5">
        <div class="card-header bg-gradient bg-dark text-white">
            <h5 class="mb-0">🔍 Recherche avancée des dossiers</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.dossiers.rechercher') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Client</label>
                    <select name="client_id" class="form-select shadow-sm">
                        <option value="">-- Tous les clients --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Année</label>
                    <input type="number" name="annee" class="form-control shadow-sm" placeholder="Ex : 2025">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Mois</label>
                    <input type="number" name="mois" class="form-control shadow-sm" placeholder="1 à 12">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jour</label>
                    <input type="number" name="jour" class="form-control shadow-sm" placeholder="1 à 31">
                </div>
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary px-4 fw-semibold" style="background-color: #00ab4a">
                        <i class="bi bi-search me-1"></i> Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-4 col-md-6">
            <div class="card text-white shadow border-0 h-100" style="background-color: #00ab4a;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold mb-3"><i class="bi bi-credit-card-2-back-fill me-2"></i>Paiements</h5>
                    <ul class="list-unstyled mb-3">
                        <li><i class="bi bi-clock-history me-1"></i> En attente : <strong>{{ $paiementsEnAttente->count() }}</strong></li>
                        <li><i class="bi bi-check-circle-fill me-1"></i> Terminés : <strong>{{ $paiementsTermines->count() }}</strong></li>
                    </ul>
                    <hr class="bg-light">
                    <p class="mb-1">Total Clients</p>
                    <h4 class="fw-bold">{{ $totalClients }}</h4>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card bg-dark text-white shadow border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold mb-3"><i class="bi bi-folder-fill me-2"></i>Dossiers</h5>
                    <ul class="list-unstyled mb-3">
                        <li><i class="bi bi-hourglass-split me-1"></i> En attente : <strong>{{ $dossiersEnAttente->count() }}</strong></li>
                        <li><i class="bi bi-arrow-repeat me-1"></i> En cours : <strong>{{ $dossiersEnCours->count() }}</strong></li>
                    </ul>
                    <hr class="bg-light">
                    <p class="mb-1">Total Dossiers</p>
                    <h4 class="fw-bold">{{ $totalDossiers }}</h4>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white shadow border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold mb-3"><i class="bi bi-receipt me-2"></i>Factures</h5>
                    <ul class="list-unstyled mb-3">
                        <li><i class="bi bi-clock me-1"></i> En attente : <strong>{{ $facturesEnAttente->count() }}</strong></li>
                        <li><i class="bi bi-cash-stack me-1"></i> Payées : <strong>{{ $facturesPayees->count() }}</strong></li>
                    </ul>
                    <hr class="bg-light">
                    <p class="mb-1">Total Factures</p>
                    <h4 class="fw-bold">{{ $totalFactures }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
