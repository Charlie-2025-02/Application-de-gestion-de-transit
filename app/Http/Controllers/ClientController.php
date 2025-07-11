<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Dossier;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Message;


class ClientController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $client = Client::where('user_id', $user->id)->first();

        if (!$client) {
            return redirect()->route('client.create')
                ->with('warning', 'Veuillez d’abord créer votre profil client.');
        }

        $client = Auth::user()->client;

        $dossiers = Dossier::where('client_id', $client->id)->latest()->get();

        $dossiersEnCours = Dossier::where('client_id', $client->id)
                                ->where('statut', 'en_cours') // ou 'en cours'
                                ->count();

        return view('client.dashboard', compact('client', 'dossiers', 'dossiersEnCours'));


        $dossiers = $client->dossiers()->latest()->take(5)->get();

        $dossiersEnCours = $dossiers->where('statut', 'en cours', 'en_attente', 'en_cours', 'terminé', 'annulé',)->count();

        $tousDossiers = $client->dossiers;

        $dossiersRecents = $tousDossiers->sortByDesc('created_at')->take(5);

        $dossiersEnCours = $tousDossiers->where('statut', 'en cours', 'en_attente', 'en_cours', 'terminé', 'annulé',)->count();

        return view('client.dashboard', [
            'client' => $client,
            'dossiers' => $dossiersRecents,
            'dossiersEnCours' => $dossiersEnCours,
        ]);

        return view('client.dashboard', compact('client', 'dossiers', 'dossiersEnCours'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->client) {
            return redirect()->route('client.dashboard')
                            ->with('info', 'Vous avez déjà un profil client.');
        }

        if (Client::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'Un client avec cet e-mail existe déjà.']);
        }

        return view('client.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->client) {
            return redirect()->route('client.dashboard')
                            ->with('info', 'Vous avez déjà un profil client.');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'entreprise' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:clients,email',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
        ]);

        Client::create([
            'nom' => $request->nom,
            'entreprise' => $request->entreprise,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Profil client créé avec succès.');
    }

    public function index()
    {

        $client = Auth::user()->client;

        if (!$client) {
            $dossiers = collect();
        } else {
            $dossiers = Dossier::where('client_id', $client->id)->latest()->get();
        }

        return view('client.dossiers.index', compact('dossiers'));

    }

    public function facturees()
    {
        $user = Auth::user();

        $client = Client::where('user_id', $user->id)->first();

        if (!$client) {
            $factures = collect();
        } else {

            $factures = Facture::with('dossier')->where('client_id', $client->id)->get();
        }

        return view('client.facturees.index', compact('factures'));
    }

    public function paiements()
    {
        $client = Auth::user()->client;

        if (!$client) {
            $paiements = collect();
        } else {
            $paiements = Paiement::with('facture')
                ->where('client_id', $client->id)
                ->orderByDesc('date_paiement')
                ->get();
        }

        return view('client.paiements.index', compact('paiements'));
    }

    public function nouveauPaiement()
    {
        $client = Auth::user()->client;

        if (!$client) {
            return redirect()->route('client.dashboard')->with('warning', 'Profil client requis.');
        }

        $factures = Facture::where('client_id', $client->id)
            ->where('statut', 'en_attente')
            ->get();

        return view('client.paiements.create', compact('factures'));
    }

    public function storePaiement(Request $request)
    {
        $request->validate([
            'facture_id' => 'required|exists:factures,id',
            'nom_titulaire' => 'required|string|max:255',
            'numero_carte' => 'required|string|max:20',
            'cvv' => 'required|string|max:4',
            'expiration' => 'required|string|max:10',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'statut' => 'required|in:payé,annulé',
        ]);

        $client = Auth::user()->client;
        $facture = Facture::findOrFail($request->facture_id);

        if ($facture->client_id !== $client->id) {
            return redirect()->back()->withErrors(['facture_id' => 'Facture invalide pour ce client.']);
        }

        if ($request->montant != $facture->montant_ttc) {
            return back()->withErrors(['montant' => 'Le montant à payer ne correspond pas au montant de la facture.'])->withInput();
        }

        $paiement = new Paiement();
        $paiement->facture_id = $facture->id;
        $paiement->client_id = $client->id;
        $paiement->user_id = Auth::id();

        $paiement->nom_titulaire = $request->nom_titulaire;
        $paiement->numero_carte = $request->numero_carte;
        $paiement->cvv = $request->cvv;
        $paiement->expiration = $request->expiration;
        $paiement->montant = $request->montant;
        $paiement->date_paiement = $request->date_paiement;

        $paiement->statut = 'paye';
        $paiement->save();

        $facture->statut = 'paye';
        $facture->save();

        $dossier = $facture->dossier;

        if ($dossier) {
            $dossier->statut = 'en_cours';
            $dossier->save();
            Log::info("Dossier mis à jour", ['id' => $dossier->id, 'nouveau_statut' => $dossier->statut]);
        } else {
            Log::error("Aucun dossier trouvé pour la facture ID " . $facture->id);
        }


        if ($facture->statut === 'paye' && $paiement->statut === 'paye') {
            $dossier = $facture->dossier;

            if ($dossier && $dossier->statut !== 'en_cours') {
                $dossier->statut = 'en_cours';
                $dossier->save();
            }
        }


        return redirect()->route('client.paiements.index')->with('success', 'Paiement enregistré avec succès.');
    }

    public function messages()
    {
        $userId = Auth::id();

        $messages = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.messages.index', compact('messages'));
    }

    public function createMessage()
    {
        return view('client.messages.create');
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => 1,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('client.messages.index')->with('success', 'Message envoyé.');
    }
}
