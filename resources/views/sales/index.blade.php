@extends('layouts.app')

@section('title', 'Ventes')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Liste des Ventes</h2>
            <a href="{{ route('sales.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
                Ajouter une Vente
            </a>
        </div>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 text-left">Référence</th>
                    <th class="p-3 text-left">Client</th>
                    <th class="p-3 text-left">Produits</th>
                    <th class="p-3 text-left">Quantité</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                <tr class="border-t hover:bg-gray-50 transition duration-300">
                    <td class="p-3">{{ $sale->reference }}</td>
                    <td class="p-3">{{ $sale->client->name }}</td>
                    <td class="p-3">{{ implode(', ', $sale->products->pluck('name')->toArray()) }}</td>
                    <td class="p-3">{{ $sale->quantity }}</td>
                    <td class="p-3">{{ number_format($sale->total, 2) }} €</td>
                    <td class="p-3">
                        <a href="{{ route('sales.show', $sale->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Voir</a>
                        <a href="{{ route('sales.edit', $sale->id) }}" class="text-green-500 hover:text-green-700 mr-2">Modifier</a>
                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection