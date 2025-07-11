@extends('layouts.admin')

@section('title', 'Répondre au client')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="mb-4">
                <h2 class="text-primary fw-bold">✉️ Répondre à {{ $client->name }}</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.message.repondre', $client->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="contenu" class="form-label">Votre message</label>
                            <textarea name="contenu" id="contenu" class="form-control" rows="5" placeholder="Écrivez votre réponse ici..." required></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">
                                ← Retour à la liste
                            </a>
                            <button type="submit" class="btn btn-success">
                                ✅ Envoyer la réponse
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
