<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $salesToday = DB::table('sales')->whereDate('created_at', today())->sum('amount');
        $salesYesterday = DB::table('sales')->whereDate('created_at', today()->subDay())->sum('amount');
        $salesThisMonth = DB::table('sales')->whereMonth('created_at', today()->month)->sum('amount');
        $salesLastMonth = DB::table('sales')->whereMonth('created_at', today()->subMonth())->sum('amount');

        return view('products.index', compact('salesToday', 'salesYesterday', 'salesThisMonth', 'salesLastMonth'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new product
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        DB::table('products')->insert([
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/products')->with('success', 'Product added successfully!');
    }

    public function sell($productId, $quantity)
    {
        // Update product quantity and record the sale
        $product = DB::table('products')->find($productId);

        if (!$product) {
            return redirect('/products')->with('error', 'Product not found!');
        }

        if ($product->quantity < $quantity) {
            return redirect('/products')->with('error', 'Insufficient stock!');
        }

        DB::table('products')->where('id', $productId)->decrement('quantity', $quantity);

        // Record the sale in a 'sales' table
        DB::table('sales')->insert([
            'product_id' => $productId,
            'quantity' => $quantity,
            'amount' => $quantity * $product->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/products')->with('success', 'Product sold successfully!');
    }
    public function changePrice($productId, $newPrice)
    {
        // Update the product price
        $product = DB::table('products')->find($productId);

        if (!$product) {
            return redirect('/products')->with('error', 'Product not found!');
        }

        DB::table('products')->where('id', $productId)->update([
            'price' => $newPrice,
            'updated_at' => now(),
        ]);

        return redirect('/products')->with('success', 'Product price updated successfully!');
    }
}

