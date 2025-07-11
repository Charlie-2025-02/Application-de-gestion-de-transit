<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use App\Models\Dossier;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class FactureController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    public function create()
    {
        $clients = Client::all();
        $dossiers = Dossier::all();
        return view('admin.factures.create', compact('clients', 'dossiers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'dossier_id' => 'required|exists:dossiers,id',
            'date_facture' => 'required|date',
            'montant_ht' => 'required|numeric|min:0',
            'statut' => 'required|in:en_attente,paye,annule',
        ]);

        $tva = 18;
        $montant_ttc = $request->montant_ht * (1 + ($tva / 100));
        $numero = 'FAC-' . strtoupper(uniqid());

        Facture::create([
            'user_id' => Auth::id(),
            'numero_facture' => $numero,
            'client_id' => $request->client_id,
            'dossier_id' => $request->dossier_id,
            'date_facture' => $request->date_facture,
            'montant_ht' => $request->montant_ht,
            'tva' => $tva,
            'montant_ttc' => $montant_ttc,
            'statut' => $request->statut,
        ]);

        return redirect()->route('admin.factures.index')->with('success', 'Facture créée avec succès.');
    }


    public function index()
    {
        $factures = Facture::with('client', 'dossier')->latest()->paginate(8);
        return view('admin.factures.index', compact('factures'));
    }

    public function show(Facture $facture)
    {
        return view('admin.factures.show', compact('facture'));
    }

    public function edit(Facture $facture)
    {
        $clients = Client::all();
        return view('admin.factures.edit', compact('facture', 'clients'));
    }

    public function destroy($id)
    {
        $facture = Facture::findOrFail($id);
        $facture->delete();

        return redirect()->route('factures.index')->with('success', 'Facture supprimée avec succès.');
    }

    public function mesFactures()
    {
        $client = Auth::user()->client;

        if (!$client) {
            abort(403, "Aucun client associé à cet utilisateur.");
        }

        $factures = Facture::whereHas('dossier', function ($query) use ($client) {
            $query->where('client_id', $client->id);
        })->with('dossier')->latest()->get();

        return view('client.factures.index', compact('factures'));
    }

    public function getDossiersParClient($clientId)
    {
        $dossiers = Dossier::where('client_id', $clientId)
            ->where('statut', '!=', 'en_cours') // ou 'en_cours' selon ton app
            ->get(['id', 'titre']);

        return response()->json($dossiers);
    }


    public function download(Facture $facture)
    {

        $pdf = PDF::loadView('admin.factures.pdf', compact('facture'));

        return $pdf->download('facture-' . $facture->numero_facture . '.pdf');
    }

    public function genererPDF(Facture $facture)
    {
        $client = Auth::user()->client;

        if ($facture->dossier->client_id !== $client->id) {
            abort(403, 'Accès interdit.');
        }

        $pdf = Pdf::loadView('pdf.facture', compact('facture'));
        return $pdf->download("Facture-{$facture->numero_facture}.pdf");
    }
}
