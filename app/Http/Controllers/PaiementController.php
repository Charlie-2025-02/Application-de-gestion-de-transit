<?php

namespace App\Http\Controllers;

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
            return redirect()->route('home')->withErrors(['client' => 'Profil client non trouvé.']);
        }

        $factures = Facture::where('client_id', $client->id)
                           ->where('statut', 'en_attente')
                           ->get();

        return view('paiements.create', compact('factures'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $client = $user->client;

        if (!$client) {
            return redirect()->route('home')->withErrors(['client' => 'Profil client non trouvé.']);
        }

        $request->validate([
            'facture_id' => 'required|exists:factures,id',
            'nom_titulaire' => 'required|string|max:255',
            'numero_carte' => 'required|string|max:20',
            'cvv' => 'required|string|max:4',
            'expiration' => 'required|string|max:10',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
        ]);

        $facture = Facture::findOrFail($request->facture_id);

        if ($facture->client_id !== $client->id) {
            return redirect()->back()->withErrors(['facture_id' => 'Facture invalide pour ce client.']);
        }

        if ($request->montant != $facture->montant_ttc) {
            return redirect()->back()->withErrors(['montant' => 'Le montant à payer ne correspond pas au montant de la facture.'])->withInput();
        }

        $paiement = new Paiement();
        $paiement->facture_id = $facture->id;
        $paiement->client_id = $client->id;
        $paiement->user_id = $user->id;
        $paiement->nom_titulaire = $request->nom_titulaire;
        $paiement->numero_carte = $request->numero_carte;
        $paiement->cvv = $request->cvv;
        $paiement->expiration = $request->expiration;
        $paiement->montant = $request->montant;
        $paiement->date_paiement = $request->date_paiement;

        $paiement->statut = 'terminé';
        $paiement->save();

        $facture->statut = 'terminé';
        $facture->save();

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès.');
    }

    public function index()
    {
        $user = Auth::user();
        $client = $user->client;

        if (!$client) {
            return redirect()->route('home')->withErrors(['client' => 'Profil client non trouvé.']);
        }

        $paiements = Paiement::where('client_id', $client->id)
                             ->orderBy('date_paiement', 'desc')
                             ->get();

        return view('paiements.index', compact('paiements'));
    }
}
