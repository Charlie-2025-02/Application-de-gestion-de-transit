@extends('layouts.app')

@section('title', 'Contacter l’administrateur')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">📨 Contacter l’administrateur</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('client.messages.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="contenu" class="form-label fw-semibold">Votre message</label>
                            <textarea name="contenu" id="contenu" class="form-control" rows="6" required placeholder="Écrivez votre message ici..."></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success">
                                ✉️ Envoyer le message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
