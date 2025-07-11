<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=DejaVu+Sans:wght@400;700&display=swap" rel="stylesheet">

        <title>Facture N° {{ $facture->numero_facture }}</title>

        <style>
            body {
                font-family: 'DejaVu Sans', sans-serif;
                font-size: 12px;
                margin: 30px;
                color: #212529;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start; Aligne les deux blocs en haut */
                /*/* margin-bottom: 40px;
                border-bottom: 2px solid #0d6efd; */
                /* padding-bottom: 10px; */
                width: 100px;
                height: 100px;
                margin: 3px auto;
                margin-bottom: 80px;
            }

            .logo {
                flex: 0 0 auto; Ne prend que la taille de l'image
            }

            .logo img {
                width: 100px;
                height: auto;
            }

            .entreprise {
                /* flex: 1; Prend tout l'espace restant */
                text-align: right;
                font-size: 11px;
                line-height: 1.5;
                height: -500px;
                margin-top: -950px;
                /* margin-bottom: 900px; */
            }

            .entreprise strong {
                font-size: 16px;
                color: #0d6efd;
            }

            .facture-title {
                text-align: center;
                margin: 30px 0;
                font-size: 20px;
                font-weight: bold;
                color: #0d6efd;
                text-transform: uppercase;
                margin-bottom: 50px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 25px;
            }

            th, td {
                border: 1px solid #dee2e6;
                padding: 10px;
                text-align: left;
            }

            th { background-color: #007bff; color: #fff; }


            /* th {
                background-color: #f1f1f1;
            } */

            .table-total {
                font-weight: bold;
                font-size: 14px;
                margin-top: 20px;
            }

            .footer {
                text-align: center;
                margin-top: 60px;
                font-size: 11px;
                color: #6c757d;
            }
        </style>
    </head>
    <body>

        <div class="header mb-5">
            <div class="logo">
                <img src="{{ public_path('images/Image11.png') }}" alt="Logo TransGest">
            </div>
            <div class="entreprise">
                <strong>TransGest</strong><br>
                Abomey-Calavi / Cotonou / Porto-Novo, Bénin<br>
                Téléphone : +229 0149494949<br>
                Email : contact@transgest.com
            </div>
        </div>

        <div class="facture-title mb-4">
            FACTURE N° {{ $facture->numero_facture }}
            <p class="text-end" style="color: #000000"><strong>Créé le :</strong> {{ $facture->created_at->format('d/m/Y à H:i') }}</p>
        </div>

        {{-- <p class="text-start"><strong>Date :</strong> {{ $facture->date_facture->format('d/m/Y') }}</p> --}}
        <p class="text-start"><strong>Client :</strong> {{ $facture->dossier->client->nom }} {{ $facture->dossier->client->prenom }}</p>
        <p class="text-start"><strong>Dossier :</strong> {{ $facture->dossier->numero_dossier }} - {{ $facture->dossier->titre }}</p>
        {{-- <p class="text-start"><strong>Dossier :</strong> {{ $facture->dossier->numero_dossier }} - {{ $facture->dossier->titre }}</p> --}}
        <p class="text-start"><strong>Type de transport :</strong> {{ ucfirst($facture->dossier->type_transport) }}</p>
        <p class="text-start"><strong>Départ :</strong> {{ $facture->dossier->depart }}</p>
        <p class="text-start"><strong>Arrivée :</strong> {{ $facture->dossier->arrivee }}</p>
        <p class="text-start"><strong>Date de départ :</strong> {{ \Carbon\Carbon::parse($facture->dossier->date_depart)->format('d/m/Y') }}</p>
        <p class="text-start"><strong>Date d'arrivée prévue :</strong> {{ \Carbon\Carbon::parse($facture->dossier->date_arrivee)->format('d/m/Y') }}</p>
        {{-- <p class="text-start"><strong>Véhicule :</strong> {{ $facture->dossier->vehicule }}</p> --}}
        {{-- <p class="text-start"><strong>Chauffeur :</strong> {{ $facture->dossier->chauffeur }}</p> --}}
        <p class="text-end"><strong>Statut :</strong>
            @switch($facture->statut)
                @case('en_attente')
                    <span class="badge bg-warning text-dark">En attente</span>
                    @break
                @case('en_cours')
                    <span class="badge bg-primary">En cours</span>
                    @break
                @case('paye')
                    <span class="badge bg-success">Payé</span>
                    @break
                @case('annule')
                    <span class="badge bg-danger">Annulé</span>
                    @break
                @default
                    <span class="badge bg-secondary">Inconnu</span>
            @endswitch
        </p>
        <p class="text-end"><strong>Remarques :</strong> {{ $facture->dossier->remarques ?? 'Aucune' }}</p>
        {{-- <p class="text-end"><strong>Créé le :</strong> {{ $facture->created_at->format('d/m/Y H:i') }}</p> --}}
        <p class="text-end"><strong>Mis à jour le :</strong> {{ $facture->updated_at->format('d/m/Y H:i') }}</p>
        <p class="text-end"><strong>Montant TTC :</strong> {{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</p>
        <p class="text-end"><strong>Montant HT :</strong> {{ number_format($facture->montant_ht, 0, ',', ' ') }} FCFA</p>
        <p class="text-end"><strong>TVA (18%) :</strong> {{ number_format($facture->tva, 0, ',', ' ') }} FCFA</p>
        <table>
            <thead>
                <tr>
                    <th>Chauffeur</th>
                     <th>Vehicule</th>
                    {{--<th>Date Départ</th>
                    <th>Date Arrivée</th>--}}
                    <th>Type transport</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $facture->dossier->chauffeur}}</td>
                    <td>{{ $facture->dossier->vehicule }}</td>
                    <td>{{ ucfirst($facture->dossier->type_transport)}}</td>
                    <td>{{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>

        <p class="table-total">Total TTC : {{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</p>

        <div class="footer mb-5">
            Merci pour votre confiance.
        </div>

    </body>
</html>
