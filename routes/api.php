<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DossierController;
use App\Models\Dossier;

Route::get('/dossiers-by-client/{client}', [DossierController::class, 'getByClient']);

Route::get('/dossiers-by-client/{client}', [DossierController::class, 'getByClient']);

Route::get('/dossiers-by-client/{client}', [\App\Http\Controllers\Api\DossierController::class, 'getByClient']);


Route::get('/dossiers-by-client/{client}', [DossierController::class, 'getByClient']);




Route::get('/dossiers-by-client/{client}', function ($client) {
    return Dossier::where('client_id', $client)->get(['id', 'titre']);
});
