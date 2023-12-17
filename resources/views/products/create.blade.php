<!-- resources/views/products/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Create Product</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="post">
        @csrf
        <label for="name">Product Name:</label>
        <input type="text" name="name" required>
        
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>

        <label for="price">Price:</label>
        <input type="number" name="price" required step="0.01">

        <button type="submit">Create Product</button>
    </form>
@endsection
