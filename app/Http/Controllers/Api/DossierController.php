<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dossier;

class DossierController extends Controller
{

    public function getByClient($clientId)
    {
        return Dossier::where('client_id', $clientId)->get(['id', 'titre']);
    }
}
