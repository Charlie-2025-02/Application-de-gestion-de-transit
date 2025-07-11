<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FactureLigne;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'dossier_id',
        'numero_facture',
        'date_facture',
        'montant_ht',
        'tva',
        'montant_ttc',
        'statut',
    ];

    protected $casts = [
        'date_facture' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function paiements()
    {
        return $this->hasMany(\App\Models\Paiement::class);
    }
}
