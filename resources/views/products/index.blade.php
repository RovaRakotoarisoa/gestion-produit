@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Liste des Produits</h1>
    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un Produit</a>
    <div class="mt-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Nom</th>
                    <th class="py-2">Description</th>
                    <th class="py-2">Prix de détail</th>
                    <th class="py-2">Prix de gros</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->description }}</td>
                    <td class="border px-4 py-2">{{ number_format($product->retail_price, 2) }} €</td>
                    <td class="border px-4 py-2">{{ number_format($product->wholesale_price, 2) }} €</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('products.show', $product->id) }}" class="text-blue-500">Voir</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="text-green-500 ml-2">Modifier</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
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