@extends('layouts.app')

@section('title', 'Détails de la Vente')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Détails de la Vente</h2>

        <div class="space-y-4">
            <div>
                <strong class="block text-sm font-medium text-gray-700">Référence :</strong>
                <p class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $sale->reference }}</p>
            </div>

            <div>
                <strong class="block text-sm font-medium text-gray-700">Client :</strong>
                <p class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $sale->client->name }}</p>
            </div>

            <div>
                <strong class="block text-sm font-medium text-gray-700">Produits :</strong>
                <p class="mt-1 p-3 bg-gray-50 rounded-lg">{{ implode(', ', $sale->products->pluck('name')->toArray()) }}</p>
            </div>

            <div>
                <strong class="block text-sm font-medium text-gray-700">Quantité :</strong>
                <p class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $sale->items->sum('quantity') }}</p>
            </div>

            <div>
                <strong class="block text-sm font-medium text-gray-700">Total :</strong>
                <p class="mt-1 p-3 bg-gray-50 rounded-lg">{{ number_format($sale->total, 2) }} €</p>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('sales.edit', $sale->id) }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                Modifier
            </a>
        </div>
    </div>
</div>
@endsection