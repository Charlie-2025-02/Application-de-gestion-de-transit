<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'contenu', 'lu'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function isSentByCurrentUser()
    {
        return Auth::check() && $this->sender_id === Auth::id();
    }

    public function markAsRead()
    {
        if (!$this->lu) {
            $this->lu = true;
            $this->save();
        }
    }
}
