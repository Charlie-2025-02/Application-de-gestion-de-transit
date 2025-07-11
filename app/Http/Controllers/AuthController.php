<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        if (Auth::check() && Auth::user()->role?->name === 'client') {
            return redirect()->route('client.dashboard')->with('error', 'Vous n\'êtes pas autorisé à créer un autre compte.');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $clientRole = Role::where('name', 'client')->first();

        if (!$clientRole) {
            return back()->withErrors(['role' => 'Le rôle "client" est introuvable. Veuillez d\'abord le créer en base.']);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $clientRole->id,
        ]);

        return redirect()->route('auth.login')->with('success', 'Inscription réussie. Connectez-vous.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return redirect()->route($user->role->name . '.dashboard')->with('success', 'Connexion réussie. Bienvenue !');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
