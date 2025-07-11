<?php

namespace App\Observers;

use App\Models\Paiement;

class PaiementObserver
{

    public function created(Paiement $paiement)
    {
        $facture = $paiement->facture;

        if (!$facture) return;

        if ($facture &&
            $paiement->montant == $facture->montant_ttc &&
            $facture->statut === 'paye'
        ) {
            $dossier = $facture->dossier;

            if ($dossier && $dossier->statut !== 'terminé') {
                $dossier->statut = 'terminé';
                $dossier->save();
            }
        }
    }
}
