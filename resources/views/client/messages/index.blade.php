@extends('layouts.app')

@section('title', 'Mes messages')

@section('content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📩 Ma messagerie</h4>
            <a href="{{ route('client.messages.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Nouveau message
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($messages->isEmpty())
                <div class="alert alert-info text-center">
                    Aucun message trouvé.
                </div>
            @else
                <div class="list-group">
                    @foreach($messages as $message)
                        <div class="list-group-item list-group-item-action mb-2 border rounded shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-1 fw-bold d-flex align-items-center gap-2">
                                    @if($message->sender_id === auth()->id())
                                        <i class="bi bi-person-fill text-primary" title="Vous"></i>
                                        <span>Vous</span>
                                        <i class="bi bi-arrow-right mx-1 text-muted"></i>
                                        <i class="bi bi-shield-lock-fill text-success" title="Admin"></i>
                                        <span>Admin</span>
                                    @elseif($message->receiver_id === auth()->id())
                                        <i class="bi bi-shield-lock-fill text-success" title="Admin"></i>
                                        <span>Admin</span>
                                        <i class="bi bi-arrow-right mx-1 text-muted"></i>
                                        <i class="bi bi-person-fill text-primary" title="Vous"></i>
                                        <span>Vous</span>
                                    @else
                                        <i class="bi bi-envelope-exclamation-fill text-warning"></i>
                                        <span>Message externe</span>
                                    @endif
                                </h6>
                                <small class="text-muted">
                                    {{ $message->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <p class="mb-0 mt-2 text-secondary">
                                {{ $message->contenu }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
