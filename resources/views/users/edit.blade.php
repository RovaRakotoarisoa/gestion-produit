@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Modifier l'Utilisateur</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nom</label>
            <input type="text" name="name" id="name" class="border rounded px-4 py-2 w-full" value="{{ $user->name }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border rounded px-4 py-2 w-full" value="{{ $user->email }}" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Mot de passe</label>
            <input type="password" name="password" id="password" class="border rounded px-4 py-2 w-full">
        </div>
        <div class="mb-4">
            <label for="avatar" class="block text-gray-700">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="border rounded px-4 py-2 w-full">
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Avatar" class="w-10 h-10 rounded-full">
            @endif
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Mettre à jour</button>
         <a href="{{ route('users.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Retour</a>
    </form>
</div>
@endsection