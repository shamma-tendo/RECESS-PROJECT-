<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;

class InventoryController extends Controller
{
    // Show all inventory items
    public function index()
    {
        $inventory = Inventory::with('product')->get();
        return view('inventory.index', compact('inventory'));
    }

    // Show form to add stock
    public function create()
    {
        $products = Product::all();
        return view('inventory.create', compact('products'));
    }

    // Store or update inventory entry
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $inventory = Inventory::firstOrNew([
            'product_id' => $request->product_id
        ]);

        // If existing, add to current quantity
        $inventory->quantity = $inventory->quantity + $request->quantity;
        $inventory->save();

        return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully.');
    }
}
