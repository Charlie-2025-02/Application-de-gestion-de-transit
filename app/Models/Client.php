<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'telephone', 'adresse', 'entreprise', 'user_id', 'created_at', 'updated_at'];


    public function dossiers()
    {
        return $this->hasMany(Dossier::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function factures()
    {
        return $this->hasManyThrough(Facture::class, Dossier::class, 'client_id', 'dossier_id');
    }


    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

}
