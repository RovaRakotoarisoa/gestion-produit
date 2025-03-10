<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Afficher la liste des ventes.
     */
    public function index()
    {
       $sales = Sale::with(['client', 'items.product'])->latest()->get();
       // dd($sales->toArray());
    return view('sales.index', compact('sales'));
    }

    /**
     * Afficher le formulaire de création d'une vente.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        $reference = 'INV-' . Str::upper(Str::random(8));
        return view('sales.create', compact('clients', 'products', 'reference'));
    }

    /**
     * Stocker une nouvelle vente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $sale = Sale::create([
            'reference' => $request->reference,
            'client_id' => $request->client_id,
            'total' => 0, // Sera mis à jour après l'ajout des produits
        ]);

        $this->processSaleItems($sale, $request->items);

        return redirect()->route('sales.index')->with('success', 'Vente créée avec succès');
    }

    /**
     * Afficher les détails d'une vente.
     */
    public function show(Sale $sale)
    {
        $sale->load('client', 'items.product');
        return view('sales.show', compact('sale'));
    }

    /**
     * Afficher le formulaire d'édition d'une vente.
     */
    public function edit(Sale $sale)
    {
        $clients = Client::all();
        $products = Product::all();
        $sale->load('items.product');
        return view('sales.edit', compact('sale', 'clients', 'products'));
    }

    /**
     * Mettre à jour une vente.
     */
    public function update(Request $request, Sale $sale)
    {
        // Valider les données de la requête
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $sale->update(['client_id' => $request->client_id,]);

        $sale->items()->delete();

        $this->processSaleItems($sale, $request->items);

        return redirect()->route('sales.index')->with('success', 'Vente mise à jour avec succès');
    }

    /**
     * Supprimer une vente.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete(); // La suppression en cascade supprimera également les SaleItems
        return redirect()->route('sales.index')->with('success', 'Vente supprimée avec succès');
    }

    /**
     * Récupérer les informations d'un produit via AJAX.
     */
    public function getProductInfo(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        return response()->json($product);
    }

    /**
     * Traiter les éléments de vente.
     */
    private function processSaleItems($sale, $items)
    {
        $saleTotal = 0;

        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $itemTotal = $item['quantity'] * $product->retail_price;
            
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->retail_price,
                'total' => $itemTotal
            ]);

            $saleTotal += $itemTotal;
        }
        $sale->update(['total' => $saleTotal]);
    }
    
}