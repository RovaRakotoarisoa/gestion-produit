@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Ajouter un Utilisateur</h1>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nom</label>
            <input type="text" name="name" id="name" class="border rounded px-4 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border rounded px-4 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="username" class="block text-gray-700">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" class="border rounded px-4 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Mot de passe</label>
            <input type="password" name="password" id="password" class="border rounded px-4 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="avatar" class="block text-gray-700">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="border rounded px-4 py-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
         <a href="{{ route('users.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Retour</a>
    </form>
</div>
@endsection