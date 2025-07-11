<form method="GET" action="{{ route('admin.rechercher.recherches') }}">
    <select name="client_id" class="form-control mb-2">
        <option value="">-- Tous les clients --</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->nom }}</option>
        @endforeach
    </select>

    <input type="number" name="annee" placeholder="Année" class="form-control mb-2">
    <input type="number" name="mois" placeholder="Mois" class="form-control mb-2">
    <input type="number" name="jour" placeholder="Jour" class="form-control mb-2">

    <button type="submit" class="btn btn-success">Rechercher</button>
</form>
