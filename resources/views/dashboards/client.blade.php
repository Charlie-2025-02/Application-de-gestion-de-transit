@extends('layouts.app')

@section('title', 'Tableau de bord client')

@section('content')
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h2>Bienvenue, {{ Auth::user()->name }}</h2>
            <p class="lead">Voici votre tableau de bord TransGest.</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Dossiers en cours</h5>
                        <p class="card-text display-6 text-primary">{{ $dossiersEnCours }}</p>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <h4>Derniers dossiers</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dossiers as $dossier)
                    <tr>
                        <td>{{ $dossier->reference }}</td>
                        <td>{{ $dossier->created_at->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($dossier->statut) }}</td>
                        <td><a href="{{ route('client.dossiers.show', $dossier) }}" class="btn btn-sm btn-primary">Voir</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
