<footer id="footer" class=" text-light py-4 mt-5 shadow-sm" style="background-color:#006633;">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <div class="container">
        <div class="row gy-4" style="gap: 4rem;">
            <div class="col-lg-4 col-md-6 footer-about text-center text-md-start">
                <a class="navbar-brand fw-bold text-primary d-inline-block mb-3" href="#">
                    <div style="
                        height: 150px;
                        width: 150px;
                        background-color: white;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        box-shadow: 0 0 10px rgba(0,0,0,0.2);
                        margin: 0 auto;
                    ">
                        <img src="{{ asset('images/Image11.png') }}" alt="Logo TransGest" style="height: 215px; width: auto; object-fit: contain; margin-left: -15px; margin-top: -8px;">
                    </div>
                </a>

                <div class="social-links d-flex justify-content-center justify-content-md-start mt-1 gap-3">
                    <a href="#" class="text-primary fs-4"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-primary fs-4"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-primary fs-4"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-primary fs-4"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 footer-links text-center">
                <h5 class="text-uppercase text-light mb-3 border-bottom pb-1 d-inline-block">Liens utiles</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('accueil') }}" class="text-light text-decoration-none">Accueil</a></li>
                    <li><a href="{{ route('apropos') }}" class="text-light text-decoration-none">À propos de TransGest</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Nos engagements</a></li>
                    <li><a href="#" class="text-light text-decoration-none">CGU & Confidentialité</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-links text-center">
                <h5 class="text-uppercase text-light mb-3 border-bottom pb-1 d-inline-block">Modules clients</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('client.dossiers.index') }}" class="text-light text-decoration-none">Dossiers de transport</a></li>
                    <li><a href="{{ route('client.facturees') }}" class="text-light text-decoration-none">Suivi des factures</a></li>
                    <li><a href="{{ route('client.messages.index') }}" class="text-light text-decoration-none">Messagerie client</a></li>
                    <li><a href="{{ route('client.paiements.index') }}" class="text-light text-decoration-none">Paiements</a></li>
                    <li><a href="{{ route('client.dashboard') }}" class="text-light text-decoration-none">Tableaux de bord</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-links text-center">
                <h5 class="text-uppercase text-light mb-3 border-bottom pb-1 d-inline-block">Services clients</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('auth.register') }}" class="text-light text-decoration-none">Inscription</a></li>
                    <li><a href="{{ route('auth.login') }}" class="text-light text-decoration-none">Connexion</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Support</a></li>
                </ul>
            </div>
        </div>

        <div class="text-center mt-4">
            <hr class="border-light" />
            <p class="mb-0">&copy; {{ date('Y') }} <strong>TransGest</strong> — Tous droits réservés.</p>
        </div>
    </div>
</footer>
