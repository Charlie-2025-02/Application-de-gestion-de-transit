<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $facture->numero_facture }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        h1 { color: #007bff; text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background-color: #007bff; color: #fff; }
        .total { font-weight: bold; font-size: 16px; text-align: right; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Facture #{{ $facture->numero_facture }}</h1>

    <p><strong>Client :</strong> {{ $facture->client->nom }}</p>
    <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Facture complète</td>
                <td>1</td>
                <td>{{ number_format($facture->montant_ht, 2, ',', ' ') }} FCFA</td>
                <td>{{ number_format($facture->montant_ttc, 2, ',', ' ') }} FCFA</td>
            </tr>
        </tbody>
    </table>

    <p class="total">Montant TTC : {{ number_format($facture->montant_ttc, 2, ',', ' ') }} FCFA</p>
</body>
</html>
