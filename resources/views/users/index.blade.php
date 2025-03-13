@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Liste des Utilisateurs</h1>
    <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
        Ajouter un Utilisateur
    </a>
    <div class="mt-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Nom d'utilisateur</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Avatar</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">
                            @if ($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Avatar" class="w-10 h-10 rounded-full">
                            @else
                                Pas d'avatar
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('users.show', $user->id) }}" class="text-blue-500">Voir</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="text-green-500 ml-2">Modifier</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
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