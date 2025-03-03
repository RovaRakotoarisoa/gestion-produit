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
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('client')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        $reference = 'INV-' . Str::upper(Str::random(8));
        return view('sales.create', compact('clients', 'products', 'reference'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Créer la vente
        $sale = Sale::create([
            'reference' => $request->reference,
            'client_id' => $request->client_id,
            'total' => 0, // Sera mis à jour après l'ajout des produits
        ]);

        $this->processSaleItems($sale, $request->items);

        return redirect()->route('sales.index')->with('success', 'Vente créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load('client', 'items.product');
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $clients = Client::all();
        $products = Product::all();
        $sale->load('items.product');
        return view('sales.edit', compact('sale', 'clients', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $sale->update([
            'client_id' => $request->client_id,
        ]);

        // Supprimer les anciens éléments de vente
        $sale->items()->delete();

        // Ajouter les nouveaux éléments
        $this->processSaleItems($sale, $request->items);

        return redirect()->route('sales.index')->with('success', 'Vente mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete(); // La suppression en cascade supprimera également les SaleItems
        return redirect()->route('sales.index')->with('success', 'Vente supprimée avec succès');
    }


    // Méthode pour récupérer les informations du produit via AJAX
    public function getProductInfo(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        return response()->json($product);
    }

    // Méthode pour gérer les éléments de vente
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

        // Mettre à jour le total de la vente
        $sale->update(['total' => $saleTotal]);
    }
}
