@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Liste des Clients</h1>
    <a href="{{ route('clients.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un Client</a>
    <div class="mt-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Nom</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Téléphone</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td class="border px-4 py-2">{{ $client->name }}</td>
                    <td class="border px-4 py-2">{{ $client->email }}</td>
                    <td class="border px-4 py-2">{{ $client->phone }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('clients.show', $client->id) }}" class="text-blue-500">Voir</a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="text-green-500 ml-2">Modifier</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection