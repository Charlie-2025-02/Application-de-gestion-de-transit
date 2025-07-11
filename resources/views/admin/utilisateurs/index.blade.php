@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-people-fill me-2"></i> Liste des Utilisateurs
            </h4>
            <a href="{{route ('admin.utilisateurs.create')}}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Ajouter Utilisateur
            </a>
        </div>

        <div class="card-body">
            @if($users->isEmpty())
                <div class="alert alert-info text-center">
                    Aucun utilisateur trouvé.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role && $user->role->name)
                                            <span class="badge bg-success">{{ ucfirst($user->role->name) }}</span>
                                        @else
                                            <span class="badge bg-secondary">Non défini</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.utilisateurs.edit', $user) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('admin.utilisateurs.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cet utilisateur ?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4  py-2 px-4 bg-light rounded">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

        {{-- Pagination --}}
        {{-- <div class="mt-4 d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div> --}}

    </div>
</div>
@endsection
