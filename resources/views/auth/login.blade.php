<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion à TransGest</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(to bottom, #007bff 50%, #ffffff 50%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            background-color: white;
            z-index: 1;
            margin: 40px auto;
            margin-top: 20px;
        }

        .header-title {
            color: rgba(255, 255, 255, 0.95);
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
        }

        .form-title {
            font-size: 1.3rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container {
            height: 150px;
            width: 150px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            margin: 0 auto 20px;
        }

        .logo-container img {
            height: 218px;
            object-fit: contain;
            margin-left: -15px;
            margin-top: -4px;
        }

        .custom-slow {
            --animate-duration: 7s;
        }

        @media (max-width: 576px) {
            .header-title {
                font-size: 1.6rem;
            }

            .logo-container {
                height: 120px;
                width: 120px;
            }

            .logo-container img {
                height: 160px;
                margin-left: -10px;
            }

            .form-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <div class="container px-3">
        <h1 class="header-title text-white mt-3">Bienvenue dans TransGest</h1>
        <div class="form-title">CONNECTEZ-VOUS !</div>

        <div class="login-card">
            <div class="logo-container">
                <img src="{{ asset('images/Image11.png') }}" alt="Logo TransGest">
            </div>

            <h5 class="text-center fw-semibold mb-4 animate__animated animate__fadeInDown custom-slow" style="color: #00c143;">
                Connectez-vous pour accéder à votre tableau de bord.
            </h5>

            {{-- Messages flash --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth.login') }}" method="POST">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">E-mail *</label>
                        <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label">Mot de passe *</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">SE CONNECTER</button>
                </div>

                <div class="text-center mt-4">
                    <p class="mb-2">Besoin d’un autre choix ?</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a href="{{ route('auth.register') }}" class="btn btn-outline-primary btn-sm">
                            Créer un compte
                        </a>
                        <a href="{{ route('accueil') }}" class="btn btn-outline-success btn-sm">
                            Retour à l’accueil
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
