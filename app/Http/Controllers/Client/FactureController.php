<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Client;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class FactureController extends Controller
{

    public function show(Facture $facture)
    {
        return view('Client.facturees.show', compact('facture'));
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

        return view('client.facturees.index', compact('factures'));
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

    public function generatePdf($id)
    {
        $facture = Facture::findOrFail($id);

        $pdf = Pdf::loadView('factures.pdf', compact('facture'));
        return $pdf->download('facture_'.$id.'.pdf');
    }

}
