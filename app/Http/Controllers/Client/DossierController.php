<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

class DossierController extends Controller
{

    public function dashboard(): View
    {

        $client = Auth::user()->client;

        $dossiers = Dossier::where('client_id', $client->id)->latest()->get();

        $dossiersEnCours = Dossier::where('client_id', $client->id)
                                ->where('statut', 'en_cours')
                                ->count();

        return view('client.dashboard', compact('client', 'dossiers', 'dossiersEnCours'));

    }

    public function index(Request $request): View
    {
        $client = Auth::user()->client;

        if (!$client) {
            $dossiers = collect();
        } else {
            $dossiers = Dossier::where('client_id', $client->id)->latest()->get();
        }

        return view('client.dossiers.index', compact('client', 'dossiers'));
    }

    public function show(Dossier $dossier): View
    {

        $userClient = Auth::user()->client;

        if (!$userClient || $dossier->client_id !== $userClient->id) {
            abort(403, 'Accès non autorisé à ce dossier.');
        }

        return view('client.dossiers.show', compact('dossier'));
    }

    public function create(Client $client): View
    {
        return view('client.dossiers.create', compact('client'));
    }

    public function store(Request $request, Client $client)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'objet' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|in:en_attente,en_cours,terminé',
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'type_transport' => 'required|in:terrestre,maritime,aerien',
            'date_depart' => 'required|date',
            'date_arrivee' => 'required|date',
        ]);

        $dossier = new Dossier([
            'titre' => $request->titre,
            'description' => $request->description,
            'objet' => $request->objet,
            'statut' => $request->statut,
            'depart' => $request->depart,
            'arrivee' => $request->arrivee,
            'vehicule' => $request->vehicule,
            'chauffeur' => $request->chauffeur,
            'remarques' => $request->remarques,
            'type_transport' => $request->type_transport,
            'date_depart' => $request->date_depart,
            'date_arrivee' => $request->date_arrivee,
            'user_id' => Auth::id(),
            'client_id' => $client->id,
            'numero_dossier' => 'DOS-' . strtoupper(Str::random(8)),
        ]);

        $dossier->save();

        return redirect()->route('client.dossiers.index', ['client' => $client->id])
                        ->with('success', 'Dossier créé avec succès.');

    }
}
