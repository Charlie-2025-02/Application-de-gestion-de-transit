<footer id="footer" class="text-light pt-5 pb-4 mt-5 shadow-sm" style="background-color: #00ab4a"">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <div class="container">
        <div class="row gy-4 align-items-start text-center text-md-start">

            <div class="col-md-3">
                <a href="#" class="d-flex justify-content-center justify-content-md-start mb-3">
                    <div style="
                        height: 120px;
                        width: 120px;
                        background-color: white;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        box-shadow: 0 0 15px rgba(0,0,0,0.3);
                    ">
                        <img src="{{ asset('images/Image11.png') }}" alt="Logo TransGest" style="height: 170px; width: auto; object-fit: contain; margin-left: -9px; margin-top: -5px;">
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <h5 class="text-uppercase fw-bold border-bottom pb-2 mb-3">Contact</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-telephone-fill me-2"></i>
                        <a href="tel:+22961234567" class="text-light text-decoration-none">+229 61 23 45 67</a>
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill me-2"></i>
                        <a href="mailto:transgest@gmail.com" class="text-light text-decoration-none">transgest@gmail.com</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5 class="text-uppercase fw-bold border-bottom pb-2 mb-3">Localisation</h5>
                <p class="mb-0">
                    <i class="bi bi-geo-alt-fill me-2"></i>
                    Porto-Novo, Cotonou, Calavi, Bénin
                </p>
            </div>

            <div class="col-md-3">
                <h5 class="text-uppercase fw-bold border-bottom pb-2 mb-3">Suivez-nous</h5>
                <div class="d-flex justify-content-center justify-content-md-start gap-3">
                    <a href="#" class="text-primary fs-4 social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-primary fs-4 social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-primary fs-4 social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-primary fs-4 social-link"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <hr class="border-light my-4" />

        <div class="text-center small">
            &copy; {{ date('Y') }} <strong>TransGest</strong> — Tous droits réservés.
        </div>
    </div>

    <style>
        .social-link {
            transition: transform 0.3s ease, color 0.3s ease;
        }
        .social-link:hover {
            transform: scale(1.2);
            color: #0d6efd !important;
        }
    </style>
</footer>
