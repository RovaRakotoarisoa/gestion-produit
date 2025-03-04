@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Détails de l'Utilisateur</h1>
    <div class="bg-white shadow rounded p-6">
        <p><strong>Nom :</strong> {{ $user->name }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Avatar :</strong></p>
        @if ($user->avatar)
            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full mt-2">
        @else
            <p>Pas d'avatar</p>
        @endif
    </div>
    <a href="{{ route('users.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Retour</a>
</div>
@endsection