@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Ajouter un Produit</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" id="name" class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full mt-2 p-2 border border-gray-300 rounded-md" required></textarea>
        </div>
        <div class="mb-4">
            <label for="retail_price" class="block text-sm font-medium text-gray-700">Prix de détail</label>
            <input type="number" name="retail_price" id="retail_price" class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="wholesale_price" class="block text-sm font-medium text-gray-700">Prix de gros</label>
            <input type="number" name="wholesale_price" id="wholesale_price" class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
        <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
    </form>
</div>
@endsection