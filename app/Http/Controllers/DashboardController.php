<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $todaySales = $this->getSalesForDate(Carbon::today());
        $yesterdaySales = $this->getSalesForDate(Carbon::yesterday());
        $thisMonthSales = $this->getSalesForMonth(Carbon::now());
        $lastMonthSales = $this->getSalesForMonth(Carbon::now()->subMonth());

        return view('dashboard', compact('todaySales', 'yesterdaySales', 'thisMonthSales', 'lastMonthSales'));
    }

    private function getSalesForDate($date)
    {
        return Transaction::whereDate('created_at', $date)->sum('total_amount');
    }

    private function getSalesForMonth($date)
    {
        return Transaction::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->sum('total_amount');
    }
}
