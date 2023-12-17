<!-- resources/views/transactions/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Transaction History</h2>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity Sold</th>
                <th>Total Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->product->name }}</td>
                    <td>{{ $transaction->quantity_sold }}</td>
                    <td>{{ $transaction->total_amount }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
