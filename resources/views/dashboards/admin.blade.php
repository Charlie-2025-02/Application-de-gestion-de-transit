@extends('layouts.app')

@section('title', 'Tableau de bord admin - TransGest')

@section('content')
<div class="container mt-4">
    <div class="text-center mb-4">
        <h1 class="display-4">Bienvenue sur TransGest</h1>
        <p class="lead">Administration de votre solution de gestion de transport.</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Clients</h5>
                    <p class="display-4 fw-bold">{{ $totalClients }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Dossiers</h5>
                    <p class="display-4 fw-bold">{{ $totalDossiers }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Factures</h5>
                    <p class="display-4 fw-bold">{{ $totalFactures }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h4 class="mb-0">Évolution des Clients par Mois</h4>
        </div>
        <div class="card-body">
            <canvas id="clientsChart" height="100"></canvas>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h4 class="mb-0">Nombre de dossiers par client</h4>
        </div>
        <div class="card-body">
            <canvas id="dossiersParClientChart" height="100"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const clientsCtx = document.getElementById('clientsChart').getContext('2d');
    new Chart(clientsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($clientsParMois->pluck('mois')) !!},
            datasets: [{
                label: 'Clients',
                data: {!! json_encode($clientsParMois->pluck('total')) !!},
                borderColor: 'blue',
                fill: true
            }]
        }
    });

    const dossiersCtx = document.getElementById('dossiersParClientChart').getContext('2d');
    new Chart(dossiersCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($dossiersParClient->map(function($item) {
                return $item->client ? $item->client->nom : 'Client #'.$item->client_id;
            })) !!},
            datasets: [{
                label: 'Nombre de dossiers',
                data: {!! json_encode($dossiersParClient->pluck('total')) !!},
                backgroundColor: 'green'
            }]
        }
    });
</script>
@endsection
