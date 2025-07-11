<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Admin\DossierController as AdminDossierController;
use App\Http\Controllers\Client\DossierController as ClientDossierController;
use App\Http\Controllers\Client\PaiementController as ClientPaiementController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\FactureController;
use App\Http\Controllers\Client\PaiementController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('factures', FactureController::class);
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('factures', FactureController::class);
    Route::get('/admin/dossiers/recherche', [AdminDashboardController::class, 'rechercherTousLesDossiers'])->name('admin.rechercher.dossiers');
    Route::get('/admin/recherche-dossiers', [AdminDashboardController::class, 'rechercherTousLesDossiers'])->name('admin.rechercher.dossiers');

});

Route::get('/admin/dossiers/recherche', [AdminDashboardController::class, 'rechercherTousLesDossiers'])->name('admin.rechercher.dossiers');
Route::get('/admin/recherche-dossiers', [AdminDashboardController::class, 'rechercherTousLesDossiers'])->name('admin.rechercher.dossiers');



Route::get('/mes-factures', [FactureController::class, 'mesFactures'])->name('factures.mes');
Route::get('/factures/{facture}/pdf', [FactureController::class, 'genererPDF'])->name('factures.pdf');


    Route::get('/facturees', [FactureController::class, 'index'])->name('facturees.index');
    Route::get('/facturees/{facture}', [FactureController::class, 'show'])->name('facturees.show');

    Route::get('/facturees/{facture}/pdf', [FactureController::class, 'genererPDF'])->name('facturees.pdf');
    Route::get('/mes-factures', [FactureController::class, 'mesFactures'])->name('factures.mes');
    Route::get('/factures/{facture}/telecharger', [FactureController::class, 'telecharger'])->name('factures.telecharger');

    Route::get('/facture/{id}/pdf', [FactureController::class, 'generatePdf'])->name('pdf.facture');


Route::prefix('client')->name('client.')->group(function () {
    Route::get('/facturees', [FactureController::class, 'index'])->name('facturees.index');
    Route::get('/facturees/{facture}', [FactureController::class, 'show'])->name('facturees.show');

    Route::get('/factures/{facture}/pdf', [FactureController::class, 'genererPDF'])->name('facturees.pdf');
    Route::get('/mes-factures', [FactureController::class, 'mesFactures'])->name('factures.mes');
    Route::get('/factures/{facture}/telecharger', [FactureController::class, 'telecharger'])->name('factures.telecharger');

    Route::get('/facture/{id}/pdf', [FactureController::class, 'generatePdf'])->name('pdf.facture');

    Route::resource('client', ClientController::class);
    Route::resource('facturees', FactureController::class);
    Route::get('/client/facturees', [ClientController::class, 'facturees'])->name('client.facturees');
    Route::get('/client/facturees/', [ClientController::class, 'facturees'])->name('client.facturees.index');
    Route::get('/client/facturees/index', [ClientController::class, 'facturees'])->name('client.facturees.index');

    Route::get('/client/facturees/{facture}', [ClientController::class, 'showFacture'])->name('client.facturees.show');
    Route::get('/client/facturees/{facture}/pdf', [ClientController::class, 'genererPDF'])->name('client.facturees.pdf');
    Route::get('/client/facturees/{facture}/telecharger', [ClientController::class, 'telechargerFacture'])->name('client.facturees.telecharger');
    Route::get('/client/facturees/{facture}/download', [ClientController::class, 'downloadFacture'])->name('client.facturees.download');

    Route::get('/paiements/create', [PaiementController::class, 'create'])->name('paiements.create');
    Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index'); // à créer si besoin

});

Route::get('/client/messages', [ClientController::class, 'messages'])->name('client.messages.index');
Route::get('/client/messages/nouveau', [ClientController::class, 'createMessage'])->name('client.messages.create');
Route::post('/client/messages', [ClientController::class, 'storeMessage'])->name('client.messages.store');

Route::get('/admin/messages', [AdminDashboardController::class, 'messages'])->name('admin.messages.index');
Route::get('/admin/messages/repondre/{receiver_id}', [AdminDashboardController::class, 'replyMessageForm'])->name('admin.messages.reply');
Route::post('/admin/messages/repondre', [AdminDashboardController::class, 'sendMessageReply'])->name('admin.messages.send');
Route::get('/admin/dossiers/create', [AdminDashboardController::class, 'createDossier'])->name('admin.dossiers.create');


Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard']);

Route::get('/admin/clients/create', [AdminDashboardController::class, 'createClient'])->name('admin.clients.create');
Route::post('/admin/clients', [AdminDashboardController::class, 'storeClient'])->name('admin.clients.store');

Route::get('/admin/clients/create', [AdminDashboardController::class, 'createClient'])->name('admin.clients.create');
Route::post('/admin/clients', [AdminDashboardController::class, 'storeClient'])->name('admin.clients.store');

Route::post('/admin/utilisateurs', [AdminDashboardController::class, 'storeUtilisateur'])->name('admin.utilisateurs.store');

Route::delete('/admin/utilisateurs/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.users.destroy');
Route::delete('/admin/utilisateurs/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.utilisateurs.destroy');

Route::delete('/admin/utilisateurs/{id}', [App\Http\Controllers\Admin\AdminDashboardController::class, 'destroy'])->name('admin.utilisateurs.destroy');

Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
    Route::get('/paiements/create', [PaiementController::class, 'create'])->name('paiements.create');
    Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');
});


Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('/messages', [ClientController::class, 'index'])->name('client.messages.index');
    Route::get('/messages/nouveau', [ClientController::class, 'create'])->name('messages.create');
    Route::post('/messages', [ClientController::class, 'store'])->name('messages.store');
});

    Route::get('/client/paiements', [ClientController::class, 'paiements'])->name('client.paiements');
    Route::get('/client/paiements/nouveau', [ClientController::class, 'nouveauPaiement'])->name('client.paiements.create');

    Route::get('/client/facturees/index', [ClientController::class, 'facturees'])->name('client.facturees.index');
    Route::get('/client/facturees/', [ClientController::class, 'facturees'])->name('client.facturees.index');
    Route::get('/client/messages', [ClientController::class, 'messages'])->name('client.messages.index');
    Route::get('/client/messages/nouveau', [ClientController::class, 'createMessage'])->name('client.messages.create');
    Route::post('/client/messages', [ClientController::class, 'storeMessage'])->name('client.messages.store');

    Route::get('/admin/messages', [AdminDashboardController::class, 'messages'])->name('admin.messages.index');
    Route::get('/admin/messages/repondre/{receiver_id}', [AdminDashboardController::class, 'replyMessageForm'])->name('admin.messages.reply');
    Route::post('/admin/messages/repondre', [AdminDashboardController::class, 'sendMessageReply'])->name('admin.messages.send');
    Route::post('/admin/messages/repondre/{receiver_id}', [AdminDashboardController::class, 'sendMessageReply'])->name('admin.message.repondre');

Route::middleware(['auth'])->group(function () {
    Route::get('/mes-factures', [FactureController::class, 'mesFactures'])->name('factures.mes');
    Route::get('/factures/{facture}/telecharger', [FactureController::class, 'telecharger'])->name('factures.telecharger');

    Route::get('/client/facturees', [ClientController::class, 'facturees'])->name('client.facturees');

    Route::get('/factures/{id}/pdf', [FactureController::class, 'generatePdf'])->name('pdf.facture');
});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

});


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/clients', [AdminDashboardController::class, 'listeClients'])->name('admin.clients.index');
    Route::get('/clients/{client}/edit', [AdminDashboardController::class, 'editClient'])->name('clients.edit');
    Route::put('/clients/{client}', [AdminDashboardController::class, 'updateClient'])->name('clients.update');
    Route::delete('/clients/{client}', [AdminDashboardController::class, 'deleteClient'])->name('clients.delete');
    Route::get('/clients/create', [AdminDashboardController::class, 'createClient'])->name('clients.create');
    Route::post('/clients', [AdminDashboardController::class, 'storeClient'])->name('clients.store');

    Route::get('/dossiers', [AdminDashboardController::class, 'listeDossiers'])->name('dossiers.index');
    Route::get('/dossiers/{dossier}/edit', [AdminDashboardController::class, 'editDossier'])->name('dossiers.edit');
    Route::put('/dossiers/{dossier}', [AdminDashboardController::class, 'updateDossier'])->name('dossiers.update');
    Route::delete('/dossiers/{dossier}', [AdminDashboardController::class, 'deleteDossier'])->name('dossiers.delete');

    Route::get('/factures', [AdminDashboardController::class, 'listeFactures'])->name('factures.index');
    Route::get('/factures/{facture}/edit', [AdminDashboardController::class, 'editFacture'])->name('factures.edit');
    Route::put('/factures/{facture}', [AdminDashboardController::class, 'updateFacture'])->name('factures.update');
    Route::delete('/factures/{facture}', [AdminDashboardController::class, 'deleteFacture'])->name('factures.delete');

    Route::get('/utilisateurs', [AdminDashboardController::class, 'listeUtilisateurs'])->name('utilisateurs.index');
    Route::get('/utilisateurs/{user}/edit', [AdminDashboardController::class, 'editUtilisateur'])->name('utilisateurs.edit');
    Route::put('/utilisateurs/{user}', [AdminDashboardController::class, 'updateUtilisateur'])->name('utilisateurs.update');
    Route::delete('/utilisateurs/{user}', [AdminDashboardController::class, 'deleteUtilisateur'])->name('utilisateurs.delete');
    Route::post('/utilisateurs', [AdminDashboardController::class, 'storeUtilisateur'])->name('utilisateurs.store');
    Route::delete('/utilisateurs/supprimer-tous', [AdminDashboardController::class, 'supprimerTousLesUtilisateurs'])->name('utilisateurs.supprimerTous');

    Route::delete('/utilisateurs/{user}', [AdminDashboardController::class, 'destroy'])->name('utilisateurs.destroy');
    Route::delete('/utilisateurs/{user}', [AdminDashboardController::class, 'destroy'])->name('utilisateurs.destroy');

});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('factures', [AdminDashboardController::class, 'listeFactures'])->name('factures.index');
    Route::get('factures/{facture}/telecharger', [AdminDashboardController::class, 'telechargerFacture'])->name('factures.telecharger');
});

Route::get('/admin/factures/{facture}/download', [App\Http\Controllers\Admin\FactureController::class, 'download'])->name('admin.factures.download');



Route::prefix('admin')->middleware(['auth', 'can:manage-users'])->group(function () {
    Route::resource('utilisateurs', UserController::class)->except(['show', 'create', 'store']);
});





Route::delete('/admin/utilisateurs/{user}', [AdminDashboardController::class, 'destroy'])->name('admin.utilisateurs.destroy');

Route::get('/dossiers/recherche', [AdminDashboardController::class, 'rechercherTousLesDossiers'])->name('admin.rechercher.dossiers');

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/recherche-dossiers', [AdminDashboardController::class, 'rechercherTousLesDossiers'])->name('rechercher.dossiers');

        Route::get('/dossiers/{id}', [App\Http\Controllers\Admin\DossierController::class, 'show'])
        ->name('admin.dossiers.show');

    Route::get('/dossiers/{id}', [App\Http\Controllers\client\DossierController::class, 'show'])
    ->name('admin.dossiers.show');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('factures/create', [FactureController::class, 'create'])->name('factures.create');
    Route::post('factures', [FactureController::class, 'store'])->name('factures.store');
    Route::get('/dossiers/recherche', [AdminDashboardController::class, 'rechercherTousLesDossiers'])->name('dossiers.rechercher');
    Route::get('/dossiers', [App\Http\Controllers\Admin\DossierController::class, 'index'])
        ->name('admin.dossiers.index');

    Route::get('/dossiers/{id}', [App\Http\Controllers\client\DossierController::class, 'show'])
    ->name('admin.dossiers.show');

});

Route::get('/admin/dossiers/{id}', [App\Http\Controllers\Admin\DossierController::class, 'show'])
    ->name('admin.dossiers.show');


Route::get('/recherche-dossiers', [AdminDashboardController::class, 'rechercherTousLesDossiers'])->name('rechercher.dossiers');

    Route::get('/clients', [AdminDashboardController::class, 'listeClients'])->name('admin.clients.index');
    Route::get('/clients/{client}/edit', [AdminDashboardController::class, 'editClient'])->name('clients.edit');
    Route::put('/clients/{client}', [AdminDashboardController::class, 'updateClient'])->name('clients.update');
    Route::delete('/clients/{client}', [AdminDashboardController::class, 'deleteClient'])->name('clients.delete');
    Route::get('/clients/create', [AdminDashboardController::class, 'createClient'])->name('clients.create');
    Route::post('/clients', [AdminDashboardController::class, 'storeClient'])->name('clients.store');

    Route::get('/dossiers', [AdminDashboardController::class, 'listeDossiers'])->name('dossiers.index');
    Route::get('/dossiers/{dossier}/edit', [AdminDashboardController::class, 'editDossier'])->name('dossiers.edit');
    Route::put('/dossiers/{dossier}', [AdminDashboardController::class, 'updateDossier'])->name('dossiers.update');
    Route::delete('/dossiers/{dossier}', [AdminDashboardController::class, 'deleteDossier'])->name('dossiers.delete');
    Route::get('/dossiers/create', [AdminDashboardController::class, 'createDossier'])->name('dossiers.create');
    Route::get('/dossiers/create', [AdminDashboardController::class, 'createDossier'])->name('dossiers.create');
    Route::post('/dossiers', [AdminDashboardController::class, 'storeDossier'])->name('dossiers.store');

    Route::get('/factures', [AdminDashboardController::class, 'listeFactures'])->name('factures.index');
    Route::get('/factures/{facture}/edit', [AdminDashboardController::class, 'editFacture'])->name('factures.edit');
    Route::put('/factures/{facture}', [AdminDashboardController::class, 'updateFacture'])->name('factures.update');
    Route::delete('/factures/{facture}', [AdminDashboardController::class, 'deleteFacture'])->name('factures.delete');

    Route::get('/utilisateurs', [AdminDashboardController::class, 'listeUtilisateurs'])->name('utilisateurs.index');
    Route::get('/utilisateurs/{user}/edit', [AdminDashboardController::class, 'editUtilisateur'])->name('utilisateurs.edit');
    Route::put('/utilisateurs/{user}', [AdminDashboardController::class, 'updateUtilisateur'])->name('utilisateurs.update');
    Route::delete('/utilisateurs/{user}', [AdminDashboardController::class, 'deleteUtilisateur'])->name('utilisateurs.delete');
    Route::post('/admin/utilisateurs', [AdminDashboardController::class, 'storeUtilisateur'])->name('admin.utilisateurs.store');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/clients/{client}/dossiers', [FactureController::class, 'getDossiersParClient']);


Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/apropos', function () {
    return view('apropos');
})->name('apropos');

Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/login', function () {
    return view('auth.login');
})->name('auth.login');


Route::get('/auth/register', function () {
    if (Auth::check() && Auth::user()->role?->name === 'client') {
        return redirect()->route('client.dashboard')->with('error', 'Vous ne pouvez pas créer un autre compte.');
    }
    return view('auth.register');
})->name('auth.register');

Route::get('/admin/dashboard', function () {
    return 'Bienvenue admin';
})->name('admin.dashboard');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/client/dashboard', function() {
    return view('dashboards/client');
})->name('client.dashboard');


Route::get('/admin/dashboard', function() {
    return view('dashboards/admin');
})->name('admin.dashboard');

Route::get('/test', function() {
    return view('test');
});

use App\Http\Controllers\Client\DossierController;
use App\Models\Client;


    Route::get('/dossiers/create', [DossierController::class, 'createDossier'])->name('dossiers.create');

    Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('dossiers', [DossierController::class, 'index'])->name('dossiers.index');
    Route::get('dossiers/{dossier}', [DossierController::class, 'show'])->name('dossiers.show');
    Route::get('dossiers/create', [DossierController::class, 'create'])->name('dossiers.create');

    Route::get('/mes-factures', [FactureController::class, 'mesFactures'])->name('factures.mes');
    Route::get('/factures/{facture}/telecharger', [FactureController::class, 'telecharger'])->name('factures.telecharger');
    Route::get('/client/factures', [FactureController::class, 'index'])->name('client.factures.index');
    Route::get('/factures/{facture}/pdf', [FactureController::class, 'genererPDF'])->name('factures.pdf');

    Route::get('/paiements/create', [PaiementController::class, 'create'])->name('paiements.create');
    Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index'); // si tu veux lister les paiements

    Route::get('/client/paiements', [ClientController::class, 'paiements'])->name('client.paiements');
    Route::get('/client/paiements/nouveau', [ClientController::class, 'nouveauPaiement'])->name('client.paiements.create');
    Route::post('/client/paiements', [ClientController::class, 'storePaiement'])->name('client.paiements.store');

});



Route::prefix('client')->name('client.')->middleware(['auth'])->group(function() {
    Route::resource('paiements', \App\Http\Controllers\Client\PaiementController::class)
        ->only(['index', 'create', 'store']);
});


Route::get('/client/factures', [FactureController::class, 'index'])->name('client.factures.index');
Route::get('/factures/{facture}/pdf', [FactureController::class, 'genererPDF'])->name('factures.pdf');

Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dossiers/{dossier}', [DossierController::class, 'show'])->name('dossiers.show');
});

    Route::get('/admin/dossiers/create', [AdminDashboardController::class, 'createDossier'])->name('admin.dossiers.create');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('dossiers', AdminDossierController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('dossiers', DossierController::class);
    Route::resource('dossiers', AdminDashboardController::class);
    Route::get('/admin/dossiers/create', [AdminDashboardController::class, 'createDossier'])->name('admin.dossiers.create');
    Route::post('/admin/dossiers', [DossierController::class, 'storeDossier'])->name('admin.dossiers.store');
    Route::resource('factures', FactureController::class);
    Route::get('/admin/factures', [FactureController::class, 'index'])->name('admin.factures.index');
    Route::get('/admin/factures/create', [FactureController::class, 'create'])->name('admin.factures.create');
    Route::post('/admin/factures', [FactureController::class, 'store'])->name('admin.factures.store');
    Route::get('/admin/factures/{facture}', [FactureController::class, 'show'])->name('admin.factures.show');
    Route::get('/admin/factures/{facture}/edit', [FactureController::class, 'edit'])->name('admin.factures.edit');
    Route::put('/admin/factures/{facture}', [FactureController::class, 'update'])->name('admin.factures.update');
    Route::delete('/admin/factures/{facture}', [FactureController::class, 'destroy'])->name('admin.factures.destroy');
    Route::get('/admin/factures/{facture}/download', [FactureController::class, 'download'])->name('admin.factures.download');
    Route::post('/admin/clients', [AdminDashboardController::class, 'storeClient'])->name('admin.clients.store');
});

    Route::resource('dossiers', AdminDossierController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('dossiers', DossierController::class);
    Route::resource('factures', FactureController::class);
    Route::get('/admin/factures', [FactureController::class, 'index'])->name('admin.factures.index');
    Route::get('/admin/factures/create', [FactureController::class, 'create'])->name('admin.factures.create');
    Route::post('/admin/factures', [FactureController::class, 'store'])->name('admin.factures.store');
    Route::get('/admin/factures/{facture}', [FactureController::class, 'show'])->name('admin.factures.show');
    Route::get('/admin/factures/{facture}/edit', [FactureController::class, 'edit'])->name('admin.factures.edit');
    Route::put('/admin/factures/{facture}', [FactureController::class, 'update'])->name('admin.factures.update');
    Route::delete('/admin/factures/{facture}', [FactureController::class, 'destroy'])->name('admin.factures.destroy');
    Route::get('/admin/factures/{facture}/download', [FactureController::class, 'download'])->name('admin.factures.download');

    Route::get('/admin/clients', [AdminDashboardController::class, 'listeClients'])->name('admin.clients.index');
    Route::get('/admin/clients/{client}/edit', [AdminDashboardController::class, 'editClient'])->name('admin.clients.edit');
    Route::put('/admin/clients/{client}', [AdminDashboardController::class, 'updateClient'])->name('admin.clients.update');
    Route::delete('/admin/clients/{client}', [AdminDashboardController::class, 'deleteClient'])->name('admin.clients.delete');
    Route::get('/admin/clients/create', [AdminDashboardController::class, 'createClient'])->name('admin.clients.create');
    Route::post('/admin/clients', [AdminDashboardController::class, 'storeClient'])->name('admin.clients.store');

    Route::get('/admin/dossiers', [AdminDashboardController::class, 'listeDossiers'])->name('admin.dossiers.index');
    Route::get('/admin/dossiers/{dossier}/edit', [AdminDashboardController::class, 'editDossier'])->name('admin.dossiers.edit');
    Route::put('/admin/dossiers/{dossier}', [AdminDashboardController::class, 'updateDossier'])->name('admin.dossiers.update');
    Route::delete('/admin/dossiers/{dossier}', [AdminDashboardController::class, 'deleteDossier'])->name('admin.dossiers.delete');
    Route::get('/admin/dossiers/create', [AdminDashboardController::class, 'createDossier'])->name('admin.dossiers.create');
    Route::post('/admin/dossiers', [AdminDashboardController::class, 'storeDossier'])->name('admin.dossiers.store');


    Route::get('/admin/factures', [AdminDashboardController::class, 'listeFactures'])->name('admin.factures.index');
    Route::get('/admin/factures/{facture}/edit', [AdminDashboardController::class, 'editFacture'])->name('admin.factures.edit');
    Route::put('/admin/factures/{facture}', [AdminDashboardController::class, 'updateFacture'])->name('admin.factures.update');
    Route::delete('/admin/factures/{facture}', [AdminDashboardController::class, 'deleteFacture'])->name('admin.factures.delete');

    Route::get('/admin/utilisateurs', [AdminDashboardController::class, 'listeUtilisateurs'])->name('admin.utilisateurs.index');
    Route::get('/admin/utilisateurs/{user}/edit', [AdminDashboardController::class, 'editUtilisateur'])->name('admin.utilisateurs.edit');
    Route::put('/admin/utilisateurs/{user}', [AdminDashboardController::class, 'updateUtilisateur'])->name('admin.utilisateurs.update');
    Route::delete('/admin/utilisateurs/{user}', [AdminDashboardController::class, 'deleteUtilisateur'])->name('admin.utilisateurs.delete');
    Route::get('/admin/utilisateurs/create', [AdminDashboardController::class, 'createUtilisateur'])->name('admin.utilisateurs.create');
    Route::post('/admin/utilisateurs', [AdminDashboardController::class, 'storeUtilisateur'])->name('admin.utilisateurs.store');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DossierController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

});


Route::get('/client/dashboard', [DossierController::class, 'dashboard']);
Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
Route::post('/client', [ClientController::class, 'store'])->name('client.store');


Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('dashboard', [DossierController::class, 'dashboard'])->name('dashboard');
    Route::get('dossiers', [DossierController::class, 'index'])->name('dossiers.index');
    Route::get('dossiers/{dossier}', [DossierController::class, 'show'])->name('dossiers.show');
});

Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [DossierController::class, 'dashboard'])->name('dashboard');
    Route::get('/dossiers', [DossierController::class, 'index'])->name('dossiers.index');
    Route::get('/dossiers/create', [DossierController::class, 'create'])->name('dossiers.create'); // ← Nécessaire
    Route::get('/dossiers/{dossier}', [DossierController::class, 'show'])->name('dossiers.show');
});


Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('dashboard', [DossierController::class, 'dashboard'])->name('dashboard');
    Route::resource('dossiers', DossierController::class);
});


Route::get('client/dossiers/create', [DossierController::class, 'create'])->name('client.dossiers.create');
Route::post('client/dossiers', [DossierController::class, 'store'])->name('client.dossiers.store');


Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('dossiers/create', [DossierController::class, 'create'])->name('dossiers.create');
    Route::post('dossiers', [DossierController::class, 'store'])->name('dossiers.store');
});


Route::resource('clients.dossiers', DossierController::class);
Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('dossiers/create', [DossierController::class, 'create'])->name('dossiers.create');
    Route::post('dossiers', [DossierController::class, 'store'])->name('dossiers.store');
    Route::get('dossiers/{dossier}', [DossierController::class, 'show'])->name('dossiers.show');
});

Route::resource('clients.dossiers', DossierController::class);


Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard')->middleware('auth');



Route::resource('clients', ClientController::class);


Route::resource('clients.dossiers', DossierController::class);

Route::get('/clients/{client}/dossiers/create', [DossierController::class, 'create'])->name('clients.dossiers.create');

Route::post('/clients/{client}/dossiers', [DossierController::class, 'store'])->name('clients.dossiers.store');


Route::get('/clients/{client}/dossiers', [DossierController::class, 'index'])->name('clients.dossiers.index');

Route::post('/clients/{client}/dossiers', [DossierController::class, 'store'])->name('clients.dossiers.store');

Route::post('/clients/{client}/dossiers', [DossierController::class, 'store'])->name('client.dossiers.store');

Route::post('/client/dossiers', [DossierController::class, 'store'])->name('client.dossiers.store');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');


Route::get('/admin/factures', [FactureController::class, 'index'])->name('admin.factures.index');
Route::get('/admin/factures/create', [FactureController::class, 'create'])->name('admin.factures.create');
Route::post('/admin/factures', [FactureController::class, 'store'])->name('admin.factures.store');
Route::get('/admin/factures/{facture}', [FactureController::class, 'show'])->name('admin.factures.show');
Route::get('/admin/factures/{facture}/edit', [FactureController::class, 'edit'])->name('admin.factures.edit');
Route::put('/admin/factures/{facture}', [FactureController::class, 'update'])->name('admin.factures.update');
Route::delete('/admin/factures/{facture}', [FactureController::class, 'destroy'])->name('admin.factures.destroy');
Route::get('/admin/factures/{facture}/download', [FactureController::class, 'download'])->name('admin.factures.download');

Route::get('/admin/factures/create', [FactureController::class, 'create'])->name('admin.factures.create');


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/factures', [FactureController::class, 'index'])->name('admin.factures.index');
    Route::get('/factures/create', [FactureController::class, 'create'])->name('admin.factures.create');
    Route::post('/factures', [FactureController::class, 'store'])->name('admin.factures.store');
    Route::get('/factures/{facture}', [FactureController::class, 'show'])->name('admin.factures.show');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/factures', [FactureController::class, 'index'])->name('admin.factures.index');
    Route::get('/factures/create', [FactureController::class, 'create'])->name('admin.factures.create');
    Route::post('/factures', [FactureController::class, 'store'])->name('admin.factures.store');
    Route::get('/factures/{facture}', [FactureController::class, 'show'])->name('admin.factures.show');
    Route::get('/factures/{facture}/edit', [FactureController::class, 'edit'])->name('admin.factures.edit');
    Route::put('/factures/{facture}', [FactureController::class, 'update'])->name('admin.factures.update');
    Route::delete('/factures/{facture}', [FactureController::class, 'destroy'])->name('admin.factures.destroy');
    Route::get('/factures/{facture}/download', [FactureController::class, 'download'])->name('admin.factures.download');
});
