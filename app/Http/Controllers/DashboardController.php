<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\Client;
use App\Models\Facture;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboards.admin');
    }

    public function client()
    {
        return view('dashboards.client');
    }

    public function dashboard()
    {
        $user = Auth::user();

        $client = Client::where('user_id', $user->id)->first();

        if (!$client) {
            return redirect()->route('clients.create')->with('warning', 'Veuillez d’abord créer votre profil client.');
        }

        $dossiers = $client->dossiers()->orderBy('created_at', 'desc')->get();

        $dossiersEnCours = $dossiers->where('statut', 'en cours')->count();

        return view('client.dashboard', compact('client', 'dossiers', 'dossiersEnCours'));

    }

    public function index()
    {
        $totalClients = Client::count();
        $totalDossiers = Dossier::count();
        $totalFactures = Facture::count();

        $clientsParMois = Client::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mois, COUNT(*) as total")
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $dossiersParClient = Client::select('nom')
            ->withCount('dossiers')
            ->orderByDesc('dossiers_count')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalClients',
            'totalDossiers',
            'totalFactures',
            'clientsParMois',
            'dossiersParClient'
        ));
    }

}
