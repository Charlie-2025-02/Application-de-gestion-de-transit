<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Support\Facades\DB;


class DossierController extends Controller
{
    public function index()
    {
        $dossiers = Dossier::latest()->paginate(6);
        return view('admin.dossiers.index', compact('dossiers'));
    }

    public function create()
    {
        $clients = User::whereHas('roles', function ($q) {
            $q->where('name', 'client');
        })->get();
        return view('admin.dossiers.create', compact('clients'));
    }

    public function createDossier()
    {
        $clients = Client::all();
        return view('admin.dossiers.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|unique|string|max:255',
            'statut' => 'required',
            'client_id' => 'required|exists:clients,id',
        ]);

        Dossier::create($validated);

        return redirect()->route('admin.dossiers.index')->with('success', 'Dossier créé');
    }

    public function edit(Dossier $dossier)
    {
        $clients = User::whereHas('roles', function ($q) {
            $q->where('name', 'client');
        })->get();

        $dossier->date_depart = $dossier->date_depart ? \Carbon\Carbon::parse($dossier->date_depart) : null;
        $dossier->date_arrivee = $dossier->date_arrivee ? \Carbon\Carbon::parse($dossier->date_arrivee) : null;

        return view('admin.dossiers.edit', compact('dossier', 'clients'));
    }

    public function update(Request $request, Dossier $dossier)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'numero_dossier' => 'required|string|max:255|unique:dossiers,numero_dossier,' . $dossier->id,
            'objet' => 'required|string',
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'date_depart' => 'required|date',
            'date_arrivee' => 'required|date|after_or_equal:date_depart',
            'vehicule' => 'required|string|max:255',
            'chauffeur' => 'required|string|max:255',
            'type_transport' => 'required|in:terrestre,maritime,aerien',
            'statut' => 'required|in:en_attente,en_cours,terminé',
            'client_id' => 'required|exists:clients,id',
            'remarques' => 'nullable|string',
        ]);

        $dossier->update($validated);

        return redirect()->route('admin.dossiers.index')->with('success', 'Dossier mis à jour avec succès.');
    }


    public function destroy(Dossier $dossier)
    {
        $dossier->delete();
        return redirect()->route('admin.dossiers.index')->with('success', 'Dossier supprimé');
    }


    public function show($id)
    {
        $dossier = Dossier::with('client')->findOrFail($id);
        return view('admin.dossiers.show', compact('dossier'));
    }
}
