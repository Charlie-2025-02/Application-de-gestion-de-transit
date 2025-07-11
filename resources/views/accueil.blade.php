@extends('layouts.app2')

@section('content')

<style>
    .carousel-container {
        overflow: hidden;
        position: relative;
        height: 300px;
        background-color: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 0 10px;
    }

    .carousel-track {
        display: flex;
        gap: 30px;
        width: max-content;
        animation: scroll-left 25s linear infinite;
        align-items: center;
    }

    .carousel-track img {
        height: 260px;
        border-radius: 15px;
        transition: transform 0.3s ease;
    }

    .carousel-track img:hover {
        transform: scale(1.08);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    @keyframes scroll-left {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    @media (max-width: 768px) {
        .carousel-container {
            height: 200px;
        }
        .carousel-track img {
            height: 180px;
        }
    }

    @media (max-width: 576px) {
        h1, h2 {
            font-size: 1.5rem;
        }
        .carousel-container {
            height: 180px;
        }
        .carousel-track img {
            height: 150px;
        }
    }
</style>

<div class="container py-5">

    <div class="row mb-5">
        <div class="col-lg-10 offset-lg-1 text-center">
            <h1 class="fw-bold text-dark">Bienvenue sur <span class="text-primary">TransGest</span></h1>
            <p class="lead text-muted mt-3">
                <strong>Votre solution digitale pour la gestion complète du transit : logistique, facturation et suivi client.</strong>
            </p>
        </div>
    </div>

    <div class="carousel-container mx-auto">
        <div class="carousel-track">
            @foreach ([
                'Transport_maritime.png',
                'Transport_terestre.png',
                'Transport_aérien.png',
                'Logistique.png',
                'Suivi_de_dossier.png',
                'Livraison_rapide.png'
            ] as $image)
                <img src="{{ asset('images/' . $image) }}" class="img-fluid" alt="{{ pathinfo($image, PATHINFO_FILENAME) }}">
            @endforeach

            @foreach ([
                'Transport_maritime.png',
                'Transport_terestre.png',
                'Transport_aérien.png',
                'Logistique.png',
                'Suivi_de_dossier.png',
                'Livraison_rapide.png'
            ] as $image)
                <img src="{{ asset('images/' . $image) }}" class="img-fluid" alt="{{ pathinfo($image, PATHINFO_FILENAME) }} bis">
            @endforeach
        </div>
    </div>

    <section class="mb-5">
        <h2 class="text-center fw-bold mb-4">Pourquoi choisir <span class="text-primary">TransGest</span> ?</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <i class="bi bi-shield-lock text-success display-5 mb-3"></i>
                <h5 class="fw-bold">Sécurité des données</h5>
                <p>Vos informations sont protégées avec des protocoles de sécurité avancés.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="bi bi-speedometer2 text-primary display-5 mb-3"></i>
                <h5 class="fw-bold">Gestion rapide</h5>
                <p>Optimisez votre temps avec une plateforme fluide et intuitive.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="bi bi-person-check text-warning display-5 mb-3"></i>
                <h5 class="fw-bold">Support dédié</h5>
                <p>Une équipe à votre écoute pour répondre à toutes vos questions.</p>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <h2 class="text-center fw-bold mb-4">Ils nous font confiance</h2>
        <div class="row">
            @foreach([
                ['"Grâce à TransGest, nous avons réduit nos délais de livraison de 30%. Un outil indispensable."', 'Société Global Transit'],
                ['"L’interface est simple, rapide et efficace. Je recommande à toute entreprise de transit."', 'Logistics Benin SARL'],
                ['"Une solution complète qui a transformé notre façon de gérer les opérations."', 'Africa Connect Express'],
            ] as [$quote, $author])
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <p class="card-text">{{ $quote }}</p>
                            <h6 class="fw-bold text-end">— {{ $author }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="text-center my-5">
        <h2 class="fw-bold mb-3">Rejoignez des entreprises satisfaites</h2>
        <p class="lead mb-4">Inscrivez-vous gratuitement et optimisez votre logistique dès aujourd’hui.</p>
        <a href="{{ route('auth.register') }}" class="btn btn-lg btn-success px-4">
            Créer un compte
        </a>
    </section>

</div>

@endsection
