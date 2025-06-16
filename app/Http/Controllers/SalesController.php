<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Inventory;

class SalesController extends Controller
{
    // Show product catalog
    public function index()
    {
        $products = Product::with('inventory')->get();
        return view('sales.index', compact('products'));
    }

    // Handle order placement
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $inventory = $product->inventory;

        if (!$inventory || $inventory->quantity < $request->quantity) {
            return back()->with('error', 'Insufficient stock for ' . $product->name);
        }

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'status' => 'pending',
        ]);

        $inventory->quantity -= $request->quantity;
        $inventory->save();

        return back()->with('success', 'Order placed successfully for ' . $product->name);
    }

    // View order history
    public function history()
    {
        $orders = Order::with('product')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();
        return view('sales.history', compact('orders'));
    }

    // View current order status
    public function status()
    {
        $orders = Order::with('product')
                    ->where('user_id', Auth::id())
                    ->get();
        return view('sales.status', compact('orders'));
    }

    // Admin-only: Sales report
    public function report()
    {
        $sales = Order::with('product')->get();
        $totalRevenue = $sales->sum(function($order) {
            return $order->product->price * $order->quantity;
        });

        return view('admin.report', compact('sales', 'totalRevenue'));
    }
}
