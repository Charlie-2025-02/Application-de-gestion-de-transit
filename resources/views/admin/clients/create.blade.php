@extends('layouts.admin')

@section('title', 'Créer un client')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Créer un client</div>

        <div class="card-body">
            <form action="{{ route('admin.clients.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="entreprise" class="form-label">Entreprise</label>
                    <input type="text" name="entreprise" class="form-control">
                </div>

                @php


                    $users = \App\Models\User::whereNotIn('id', \App\Models\Client::pluck('user_id'))->get();

                @endphp

                <div class="mb-3">
                    <label for="user_id" class="form-label">Associer à un utilisateur (optionnel)</label>
                    <select name="user_id" class="form-select">
                        <option value="">-- Aucun --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }}) - Rôle : {{ $user->role->name ?? 'Non défini' }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Créer</button>
            </form>
        </div>
    </div>
</div>
@endsection
