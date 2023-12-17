@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <div class="card">
        <h3>Today's Sales</h3>
        <p>Total Sales: ${{ $todaySales }}</p>
    </div>

    <div class="card">
        <h3>Yesterday's Sales</h3>
        <p>Total Sales: ${{ $yesterdaySales }}</p>
    </div>

    <div class="card">
        <h3>This Month's Sales</h3>
        <p>Total Sales: ${{ $thisMonthSales }}</p>
    </div>

    <div class="card">
        <h3>Last Month's Sales</h3>
        <p>Total Sales: ${{ $lastMonthSales }}</p>
    </div>
@endsection
