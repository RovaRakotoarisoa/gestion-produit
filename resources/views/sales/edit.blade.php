@extends('layouts.app')

@section('title', 'Modifier une Vente')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Modifier la Vente</h2>

        <form action="{{ route('sales.update', $sale->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="reference" class="block text-sm font-medium text-gray-700">Référence</label>
                <input type="text" name="reference" id="reference" value="{{ $sale->reference }}" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                <select name="client_id" id="client_id" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $sale->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="product_id" class="block text-sm font-medium text-gray-700">Produits</label>
                <select name="product_id[]" id="product_id" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" multiple required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ in_array($product->id, $sale->products->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantité</label>
                <input type="number" name="quantity" id="quantity" value="{{ $sale->quantity }}" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                <input type="number" name="total" id="total" value="{{ $sale->total }}" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" readonly>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection