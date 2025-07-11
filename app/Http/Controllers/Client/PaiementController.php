<?php

namespace App\Http\Controllers\Client;

use App\Models\Paiement;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class PaiementController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $client = $user->client;

        if (!$client) {
            return redirect()->back()->withErrors(['client' => 'Aucun profil client associé à cet utilisateur.']);
        }

        $factures = Facture::where('client_id', $client->id)
                           ->where('statut', 'en_attente')
                           ->get();

        return view('client.paiements.create', compact('factures'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $client = $user->client;

        if (!$client) {
            return redirect()->back()->withErrors(['client' => 'Aucun profil client associé à cet utilisateur.']);
        }

        $validatedData = $request->validate([
            'facture_id' => 'required|exists:factures,id',
            'nom_titulaire' => 'required|string|max:255',
            'numero_carte' => 'required|string|max:20',
            'cvv' => 'required|string|max:4',
            'expiration' => 'required|string|max:10',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
        ]);

        $facture = Facture::findOrFail($validatedData['facture_id']);

        if ($facture->client_id !== $client->id) {
            return redirect()->back()->withErrors(['facture_id' => 'Facture invalide pour ce client.']);
        }

        if ($validatedData['montant'] != $facture->montant_ttc) {
            return redirect()->back()->withErrors(['montant' => 'Le montant à payer ne correspond pas au montant de la facture.'])->withInput();
        }

        $paiement = new Paiement();
        $paiement->facture_id = $facture->id;
        $paiement->client_id = $client->id;
        $paiement->user_id = $user->id;
        $paiement->nom_titulaire = $validatedData['nom_titulaire'];
        $paiement->numero_carte = $validatedData['numero_carte'];
        $paiement->cvv = $validatedData['cvv'];
        $paiement->expiration = $validatedData['expiration'];
        $paiement->montant = $validatedData['montant'];
        $paiement->date_paiement = $validatedData['date_paiement'];
        $paiement->statut = 'terminé'; // ✅ nouveau champ
        $paiement->save();

        $facture->statut = 'paye';
        $facture->save();


        $paiements = Paiement::with('facture')->get();
        foreach ($paiements as $paiement) {
            if ($paiement->facture && $paiement->montant == $paiement->facture->montant_ttc) {
                $paiement->statut = 'terminé';
                $paiement->save();

                if ($paiement->facture->statut === 'paye' && $paiement->statut === 'terminé') {
                    $dossier = $paiement->facture->dossier;
                    if ($dossier && $dossier->statut !== 'en_cours') {
                        $dossier->statut = 'en_cours';
                        $dossier->save();
                        echo "✅ Dossier #{$dossier->id} mis à jour en 'en_cours'\n";
                    }
                }

                echo "✔ Paiement #{$paiement->id} mis à jour en 'paye'\n";
            }
        }

        return redirect()->route('client.paiements.index')->with('success', 'Paiement enregistré avec succès.');
    }

    public function index()
    {
        $user = Auth::user();
        $client = $user->client;

        if (!$client) {
            return redirect()->back()->withErrors(['client' => 'Aucun profil client associé à cet utilisateur.']);
        }

        $paiements = Paiement::where('client_id', $client->id)
                             ->orderBy('date_paiement', 'desc')
                             ->get();

        return view('client.paiements.index', compact('paiements'));
    }
}
