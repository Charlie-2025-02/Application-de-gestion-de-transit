<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Facture;
use Illuminate\Support\Facades\Log;

class CorrigerStatutsDossiers extends Command
{
    protected $signature = 'correction:statuts-dossiers';
    protected $description = 'Corrige les statuts des dossiers liés aux factures payées';

    public function handle()
    {
        $facturesPayees = Facture::with('dossier')
            ->where('statut', 'paye')
            ->get();

        $corrections = 0;

        foreach ($facturesPayees as $facture) {
            $dossier = $facture->dossier;

            if ($dossier && $dossier->statut !== 'terminé') {
                $oldStatut = $dossier->statut;
                $dossier->statut = 'terminé';
                $dossier->save();

                $this->info("✔ Dossier #{$dossier->id} mis à jour de '{$oldStatut}' à 'terminé'");
                Log::info("Correction statut dossier", [
                    'dossier_id' => $dossier->id,
                    'ancien_statut' => $oldStatut,
                    'nouveau_statut' => 'terminé',
                ]);

                $corrections++;
            }
        }

        if ($corrections === 0) {
            $this->info("✅ Aucun statut à corriger. Tout est à jour !");
        } else {
            $this->info("✅ $corrections dossier(s) mis à jour.");
        }

        return Command::SUCCESS;
    }
}
