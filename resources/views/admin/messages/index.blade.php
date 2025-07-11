@extends('layouts.admin')

@section('title', 'Messages des clients')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">
                    <i class="bi bi-chat-left-text-fill me-2"></i> Messages des Clients
                </h2>
                <p class="text-muted">Consultez et répondez directement aux messages envoyés par vos clients.</p>
            </div>

            @if($messages->isEmpty())
                <div class="alert alert-info text-center shadow-sm">
                    <i class="bi bi-info-circle me-2"></i> Aucun message reçu pour le moment.
                </div>
            @else
                @foreach($messages as $message)
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-person-circle me-2"></i>
                                <strong>{{ $message->sender->name }}</strong>
                            </div>
                            <small>
                                <i class="bi bi-clock me-1"></i>
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>

                        <div class="card-body">
                            <p class="mb-3">
                                <span class="fw-semibold text-muted">Message :</span><br>
                                <span class="text-dark">{{ $message->contenu }}</span>
                            </p>

                            <form action="{{ route('admin.message.repondre', $message->sender_id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}">

                                <div class="input-group">
                                    <input type="text" name="contenu" class="form-control shadow-sm" placeholder="Écrire une réponse..." required>
                                    <button class="btn btn-success" type="submit">
                                        <i class="bi bi-send-fill me-1"></i> Envoyer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection
