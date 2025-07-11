<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Dossier;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class AdminDashboardController extends Controller
{

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $clients = Client::all();

        $totalClients = Client::count();
        $totalDossiers = Dossier::count();
        $totalFactures = Facture::count();

        $clientsParSemaine = Client::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%u') as semaine"),
            DB::raw("COUNT(*) as total")
        )
        ->groupBy('semaine')
        ->orderBy('semaine')
        ->get();

        $clientsParSemaineLabels = $clientsParSemaine->map(function($item) {
            $parts = explode('-', $item->semaine);
            return 'Semaine ' . $parts[1] . ' (' . $parts[0] . ')';
        });

        $clientsParSemaineTotals = $clientsParSemaine->pluck('total');

        $dossiersParClient = Client::withCount('dossiers')->get();
        $dossiersClientLabels = $dossiersParClient->pluck('nom');
        $dossiersClientTotals = $dossiersParClient->pluck('dossiers_count');

        $paiementsParClient = Client::withCount('paiements')->get();
        $paiementsClientLabels = $paiementsParClient->pluck('nom');
        $paiementsClientTotals = $paiementsParClient->pluck('paiements_count');

        $dossiersEnAttente = Dossier::where('statut', 'en_attente')->get();
        $dossiersEnCours = Dossier::where('statut', 'en_cours')->get();
        $dossiersTermines = Dossier::where('statut', 'terminé')->get();

        $clients = Client::all();

        $facturesPayees = Facture::where('statut', 'paye')->get();

        $facturesEnAttente = Facture::where('statut', 'en_attente')->get();

        $paiementsTermines = Paiement::where('statut', 'terminé')->get();
        $paiementsEnAttente = Paiement::where('statut', 'en_attente')->get();

        $paiementsEnCours = Paiement::where('statut', 'en_cours')->count();

        $clients = Client::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'clients',
            'totalClients',
            'totalDossiers',
            'totalFactures',
            'clientsParSemaineLabels',
            'clientsParSemaineTotals',
            'dossiersClientLabels',
            'dossiersClientTotals',
            'paiementsClientLabels',
            'paiementsClientTotals',
            'dossiersEnAttente',
            'dossiersEnCours',
            'dossiersTermines',
            'facturesPayees',
            'facturesEnAttente',
            'paiementsTermines',
            'paiementsEnAttente',
            'paiementsEnCours',
            'clients'
        ));
    }

    public function listeClients()
    {
        $clients = Client::paginate(6);
        return view('admin.clients.index', compact('clients'));
    }

    public function editClient(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function updateClient(Request $request, Client $client)
    {
        $client->update($request->validate([
            'nom' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'nullable|string',
        ]));
        return redirect()->route('admin.clients.index')->with('success', 'Client modifié.');
    }

    public function deleteClient(Client $client)
    {
        $client->delete();
        return back()->with('success', 'Client supprimé.');
    }

    public function destroyClient(Client $client)
    {
        $client->delete();
        return back()->with('success', 'Client supprimé.');
    }

    public function createClient()
    {
        return view('admin.clients.create');
    }

    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'entreprise' => 'nullable|string|max:100',
            'user_id' => 'nullable|exists:users,id', // facultatif si tu veux lier un utilisateur existant
        ]);

        \App\Models\Client::create($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client créé avec succès.');
    }

    public function listeDossiers()
    {
        $dossiers = Dossier::with('client')->paginate(5);
        return view('admin.dossiers.index', compact('dossiers'));
    }

    public function editDossier(Dossier $dossier)
    {
        $clients = Client::all();

        $dossier->date_depart = $dossier->date_depart ? \Carbon\Carbon::parse($dossier->date_depart) : null;
        $dossier->date_arrivee = $dossier->date_arrivee ? \Carbon\Carbon::parse($dossier->date_arrivee) : null;

        return view('admin.dossiers.edit', compact('dossier', 'clients'));
    }

    public function updateDossier(Request $request, Dossier $dossier)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'numero_dossier' => 'required|string|max:255|unique:dossiers,numero_dossier,' . $dossier->id,
            'objet' => 'required|string',
            'depart' => 'required|string',
            'arrivee' => 'required|string',
            'date_depart' => 'required|date',
            'date_arrivee' => 'required|date|after_or_equal:date_depart',
            'vehicule' => 'required|string',
            'chauffeur' => 'required|string',
            'type_transport' => 'required|in:terrestre,maritime,aerien',
            'statut' => 'required|in:en_attente,en_cours,terminé',
            'client_id' => 'required|exists:clients,id',
            'remarques' => 'nullable|string',
        ]);

        $dossier->update($validated);

        return redirect()->route('admin.dossiers.index')->with('success', 'Dossier modifié avec succès.');
    }

    public function deleteDossier(Dossier $dossier)
    {
        $dossier->delete();
        return back()->with('success', 'Dossier supprimé.');
    }

    public function createDossier()
    {
        $clients = Client::all();
        return view('admin.dossiers.create', compact('clients'));
    }

    public function storeDossier(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'numero_dossier' => 'required|string|max:255|unique:dossiers,numero_dossier',
            'objet' => 'required|string',
            'depart' => 'required|string',
            'arrivee' => 'required|string',
            'date_depart' => 'required|date',
            'date_arrivee' => 'required|date|after_or_equal:date_depart',
            'vehicule' => 'required|string',
            'chauffeur' => 'required|string',
            'type_transport' => 'required|in:terrestre,maritime,aerien',
            'statut' => 'required|in:en_attente,en_cours,terminé',
            'client_id' => 'required|exists:clients,id',
            'remarques' => 'nullable|string',
        ]);

        $validated['user_id'] = \Illuminate\Support\Facades\Auth::id();

        Dossier::create($validated);

        return redirect()->route('admin.dossiers.index')->with('success', 'Dossier ajouté avec succès.');
    }

    public function listeFactures()
    {
        $factures = Facture::with(['client', 'dossier'])->paginate(10);

        return view('admin.factures.index', compact('factures'));
    }

    public function telechargerFacture(Facture $facture)
    {
        $filePath = $facture->pdf_path;

        if (!$filePath || !\Illuminate\Support\Facades\Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'Fichier facture introuvable.');
        }

        return \Illuminate\Support\Facades\Storage::download($filePath, 'facture-' . $facture->numero . '.pdf');
    }


    public function editFacture(Facture $facture)
    {
        $clients = Client::all();
        return view('admin.factures.edit', compact('facture', 'clients'));
    }

    public function updateFacture(Request $request, Facture $facture)
    {
        $facture->update($request->validate([
            'numero' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'montant' => 'required|numeric',
        ]));
        return redirect()->route('admin.factures.index')->with('success', 'Facture modifiée.');
    }

    public function deleteFacture(Facture $facture)
    {
        $facture->delete();
        return back()->with('success', 'Facture supprimée.');
    }

    public function showFacture(Facture $facture)
    {
        return view('admin.factures.show', compact('facture'));
    }

    public function listeUtilisateurs()
    {
        $utilisateurs = User::with('role')->latest()->paginate(8);
        return view('admin.utilisateurs.index', ['users' => $utilisateurs]);
    }

    public function editUtilisateur(User $user)
    {
        return view('admin.utilisateurs.edit', compact('user'));
    }

    public function updateUtilisateur(Request $request, User $user)
    {
        $user->update($request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|in:admin,client',
        ]));
        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur modifié.');
    }

    public function deleteUtilisateur(User $user)
    {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }

    public function createUtilisateur()
    {
        return view('admin.utilisateurs.create');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->syncRoles([]);
        if ($user->client) {
            $user->client->delete();
        }

        $user->delete();

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function supprimerTousLesUtilisateurs()
    {
        $utilisateurs = User::where('id', '!=', 1)->get();

        foreach ($utilisateurs as $user) {
            $user->roles([]);

            if ($user->client) {
                $user->client->delete();
            }

            $user->delete();
        }

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Tous les utilisateurs (sauf l’admin) ont été supprimés.');
    }


    public function storeUtilisateur(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|in:1,2',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur ajouté avec succès.');
    }


    public function messages()
    {
        $messages = Message::with('sender')->latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function replyMessageForm($receiver_id)
    {
        return view('admin.messages.reply', compact('receiver_id'));
    }

    public function sendMessageReply(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'contenu' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('admin.messages.index')->with('success', 'Réponse envoyée.');
    }

    public function rechercherTousLesDossiers(Request $request)
    {
        $clients = Client::all();

        $query = Dossier::query();

        if ($request->client_id) {
            $query->where('client_id', $request->client_id);
        }
        if ($request->annee) {
            $query->whereYear('created_at', $request->annee);
        }
        if ($request->mois) {
            $query->whereMonth('created_at', $request->mois);
        }
        if ($request->jour) {
            $query->whereDay('created_at', $request->jour);
        }

        $dossiers = $query->paginate(10);

        return view('admin.dossiers.recherche', compact('dossiers', 'clients'));
    }
}
