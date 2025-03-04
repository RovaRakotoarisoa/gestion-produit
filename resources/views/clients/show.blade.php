@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Détails du Client</h1>
    <div class="bg-white shadow rounded p-6">
        <p><strong>Nom :</strong> {{ $client->name }}</p>
        <p><strong>Email :</strong> {{ $client->email }}</p>
        <p><strong>Téléphone :</strong> {{ $client->phone }}</p>
    </div>
    <a href="{{ route('clients.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Retour</a>
</div>
@endsection