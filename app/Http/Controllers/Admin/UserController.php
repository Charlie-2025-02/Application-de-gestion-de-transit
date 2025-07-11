<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class UserController extends \Illuminate\Routing\Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-users');
    }

    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('admin.utilisateurs.index', compact('users'));
    }

    public function edit(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy(User $user)
    {
        if (Auth::user() && Auth::user()->id === $user->id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
