@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Détails du Produit</h1>
    <div class="bg-white p-6 rounded shadow">
        <div class="mb-4">
            <strong class="block text-sm font-medium text-gray-700">Nom :</strong>
            <p class="mt-1">{{ $product->name }}</p>
        </div>
        <div class="mb-4">
            <strong class="block text-sm font-medium text-gray-700">Description :</strong>
            <p class="mt-1">{{ $product->description }}</p>
        </div>
        <div class="mb-4">
            <strong class="block text-sm font-medium text-gray-700">Prix de détail :</strong>
            <p class="mt-1">{{ number_format($product->retail_price, 2) }} €</p>
        </div>
        <div class="mb-4">
            <strong class="block text-sm font-medium text-gray-700">Prix de gros :</strong>
            <p class="mt-1">{{ number_format($product->wholesale_price, 2) }} €</p>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('products.edit', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Modifier</a>
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
        </div>
    </div>
</div>
@endsection