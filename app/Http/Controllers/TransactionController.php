<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = DB::table('sales')->get();

    return view('products.transaction_history', compact('transactions'));
    }

    // Add methods for creating transactions, displaying sales figures, etc.
}
