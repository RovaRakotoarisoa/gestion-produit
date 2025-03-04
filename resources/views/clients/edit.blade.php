@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Modifier le Client</h1>
    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nom</label>
            <input type="text" name="name" id="name" class="border rounded px-4 py-2 w-full" value="{{ $client->name }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border rounded px-4 py-2 w-full" value="{{ $client->email }}" required>
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Téléphone</label>
            <input type="text" name="phone" id="phone" class="border rounded px-4 py-2 w-full" value="{{ $client->phone }}">
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Mettre à jour</button>
        <a href="{{ route('clients.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Retour</a>
    </form>
</div>
@endsection