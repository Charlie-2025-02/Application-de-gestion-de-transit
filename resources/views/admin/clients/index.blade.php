@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-people-fill me-2"></i> Liste des Clients</h4>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-person-plus-fill"></i> Ajouter un Client
            </a>
        </div>

        <div class="card-body">
            @if ($clients->isEmpty())
                <div class="alert alert-info text-center">
                    Aucun client enregistré pour le moment.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Entreprise</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td class="fw-semibold">{{ $client->nom }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->adresse }}</td>
                                    <td>{{ $client->telephone }}</td>
                                    <td>{{ $client->entreprise }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.clients.delete', $client) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce client ?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4  py-2 px-4 bg-light rounded" style="color: black">
                    {{ $clients->links('pagination::bootstrap-5') }}
                </div>


            @endif
        </div>
    </div>
</div>
@endsection
