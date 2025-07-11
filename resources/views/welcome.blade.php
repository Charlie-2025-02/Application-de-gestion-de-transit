@extends('layouts.app1')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-stretch">
        <div class="col-md-6 d-flex">
            <div class="card shadow w-100 mb-4">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Inscription</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemple@mail.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex">
            <div class="card shadow w-100 mb-4">
                <div class="card-header bg-success text-white text-center">
                    <h4>Connexion</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <form action="{{ route('login') }}" method="POST" class="h-100 d-flex flex-column justify-content-between">
                        @csrf
                        <div>
                            <div class="mb-3">
                                <label for="login_email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control" id="login_email" name="email" placeholder="exemple@mail.com">
                            </div>
                            <div class="mb-3">
                                <label for="login_password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="login_password" name="password" placeholder="Mot de passe">
                            </div>
                            <p class="text-muted mt-4" style="font-size: 0.9rem; text-align: center; color: #000000;">
                                <strong>Gérez vos transports et vos factures en temps réel : accédez à votre espace personnel maintenant.</strong>
                            </p>
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-auto">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
