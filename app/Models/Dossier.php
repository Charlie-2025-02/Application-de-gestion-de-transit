<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dossier extends Model
{
    use HasFactory;

    protected $fillable = ['titre','description','statut','user_id','client_id','numero_dossier','objet','type_transport','depart','arrivee','date_depart','date_arrivee','vehicule','chauffeur','remarques',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function facture() {
        return $this->hasOne(Facture::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

}
