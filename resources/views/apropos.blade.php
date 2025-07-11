@extends('layouts.app2')

@section('title', 'À propos de TransGest')

@section('content')
<div class="container py-5">

    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="fw-bold text-dark">À propos de <span class="text-primary">TransGest</span></h1>
            <p class="lead text-muted">
                <strong>TransGest est une solution web innovante dédiée à la gestion intégrale des opérations de transit.</strong><br>
                Elle permet aux entreprises de transport et de logistique de gérer facilement les dossiers clients, les factures, les paiements, et bien plus encore.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/équipe.png') }}" alt="Présentation TransGest" class="img-fluid rounded">
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="bi bi-bullseye me-2"></i>Mission</h5>
                    <p class="card-text">
                        Offrir une plateforme numérique performante, accessible et sécurisée pour améliorer
                        l’efficacité des entreprises de transit à travers une automatisation des tâches essentielles.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-warning"><i class="bi bi-target me-2"></i>Objectifs</h5>
                    <ul class="list-unstyled mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Centraliser la gestion des clients et des dossiers</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Assurer un suivi en temps réel des factures et paiements</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Offrir une messagerie client simplifiée</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Optimiser la prise de décision avec des tableaux de bord</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center mb-5">
        <h2 class="fw-bold mb-4">Nos valeurs fondamentales</h2>
        <div class="col-md-4">
            <div class="p-3 border rounded shadow-sm h-100">
                <h5 class="text-success"><i class="bi bi-shield-lock-fill me-2"></i>Fiabilité</h5>
                <p>Nous garantissons des opérations sécurisées et fiables jour après jour pour nos clients.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 border rounded shadow-sm h-100">
                <h5 class="text-warning"><i class="bi bi-lightning-fill me-2"></i>Performance</h5>
                <p>Des outils performants pour une gestion fluide et sans limitation de vos opérations.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 border rounded shadow-sm h-100">
                <h5 class="text-primary"><i class="bi bi-people-fill me-2"></i>Proximité</h5>
                <p>Une assistance rapide et proche de vous pour chaque étape de votre activité.</p>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <img src="{{ asset('images/réunion.png') }}" alt="Réunion d'équipe" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6 mb-4">
            <img src="{{ asset('images/travail.png') }}" alt="Travail collaboratif" class="img-fluid rounded shadow-sm">
        </div>
    </div>

    <div class="text-center mb-5">
        <h2 class="fw-bold">Une équipe engagée à vos côtés</h2>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-3 text-center">
            <img src="{{ asset('images/team1.png') }}" class="rounded-circle shadow-sm mb-2" width="100" alt="Lou Cossi">
            <h6 class="fw-bold mb-0">LOREM Cossi</h6>
            <small class="text-muted">Développeur & Fondateur</small>
        </div>
        <div class="col-md-3 text-center">
            <img src="{{ asset('images/team2.png') }}" class="rounded-circle shadow-sm mb-2" width="100" alt="Ange Gabriel TADAGBÉ">
            <h6 class="fw-bold mb-0">DUPOND John</h6>
            <small class="text-muted">Consultant logistique</small>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-12">
            <h2 class="fw-bold">Prêt à simplifier votre gestion de transit ?</h2>
            <p class="text-muted">Rejoignez notre plateforme intelligente dès aujourd'hui pour une gestion optimale.</p>
            <a href="{{ route('auth.register') }}" class="btn btn-success btn-lg">
                Créer un compte gratuitement
            </a>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('accueil') }}" class="btn btn-outline-primary px-4">
            <i class="bi bi-arrow-left-circle me-1"></i> Retour à l’accueil
        </a>
    </div>

</div>
@endsection
