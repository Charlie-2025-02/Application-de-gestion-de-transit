<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Role;

use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;

use App\Models\Client;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    use HasRoles;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }

    public function client()
    {
        return $this->hasOne(\App\Models\Client::class, 'user_id');
    }

    public function factures()
    {
        return $this->hasMany(\App\Models\Facture::class);
    }

    public static function booted()
    {
        static::deleting(function ($user) {
            $user->client()->delete();

            $user->roles()->detach();
        });
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

}
