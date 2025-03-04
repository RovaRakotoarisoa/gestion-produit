@extends('layouts.app')

@section('title', 'Ajouter une Vente')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Ajouter une Vente</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST" id="sale-form">
            @csrf

            <!-- Référence -->
            <div class="mb-4">
                <label for="reference" class="block text-sm font-medium text-gray-700">Référence</label>
                <input type="text" name="reference" id="reference" value="{{ $reference }}" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" readonly>
            </div>

            <!-- Client -->
            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                <select name="client_id" id="client_id" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Produits -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Produits</label>
                <div id="product-list">
                    <!-- Les champs pour les produits seront ajoutés dynamiquement ici -->
                </div>
                <button type="button" id="add-product" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
                    Ajouter un produit
                </button>
            </div>

            <!-- Total -->
            <div class="mb-4">
                <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                <input type="number" name="total" id="total-display" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" readonly>
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                    Créer la vente
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script pour gérer les produits dynamiquement -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productList = document.getElementById('product-list');
    const addProductButton = document.getElementById('add-product');
    const totalDisplay = document.getElementById('total-display');
    const products = @json($products->keyBy('id')->toArray());

    // Fonction pour ajouter un produit
    addProductButton.addEventListener('click', function () {
        const index = productList.children.length;

        const html = `
            <div class="mb-4 product-item">
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700">Produit</label>
                        <select name="items[${index}][product_id]" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->retail_price }}">{{ $product->name }} - {{ $product->retail_price }}€</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700">Quantité</label>
                        <input type="number" name="items[${index}][quantity]" class="quantity-input w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" min="1" value="1" required>
                    </div>
                    <div class="flex items-end">
                        <button type="button" class="remove-product bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        `;

        productList.insertAdjacentHTML('beforeend', html);

        // Mettre à jour le total
        updateTotal();
    });

    // Fonction pour supprimer un produit
    productList.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-product')) {
            e.target.closest('.product-item').remove();
            updateTotal();
        }
    });

    // Fonction pour mettre à jour le total
    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.product-item').forEach(item => {
            const productId = item.querySelector('select').value;
            const quantityInput = item.querySelector('.quantity-input');
            const quantity = parseInt(quantityInput.value) || 0;
            const product = products[productId];

            if (product) {
                total += quantity * product.retail_price;
            }
        });
        totalDisplay.value = total.toFixed(2);
    }

    // Écouter les changements dans les champs de quantité et de produit
    productList.addEventListener('change', function (e) {
        if (e.target.tagName === 'SELECT' || e.target.tagName === 'INPUT') {
            updateTotal();
        }
    });
});
</script>
@endsection