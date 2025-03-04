@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Ajouter un Client</h1>
    <form action="{{ route('clients.store') }}" method="POST">
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
            <label for="phone" class="block text-gray-700">Téléphone</label>
            <input type="text" name="phone" id="phone" class="border rounded px-4 py-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
        <a href="{{ route('clients.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Retour</a>
    </form>
</div>
@endsection