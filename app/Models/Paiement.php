<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;


class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'facture_id',
        'client_id',
        'user_id',
        'nom_titulaire',
        'numero_carte',
        'cvv',
        'expiration',
        'montant',
        'date_paiement',
        'statut',
    ];

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dossier()
    {
        return $this->facture ? $this->facture->dossier : null;
    }

    public function getDossierAttribute()
    {
        return $this->facture ? $this->facture->dossier : null;
    }

}
