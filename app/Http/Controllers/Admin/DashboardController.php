<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $ordersCount = Order::count();
        $totalRevenue = Order::sum('final_amount');

        $stats = [
            ['label' => 'Categories', 'value' => Category::count(), 'icon' => 'bi-grid'],
            ['label' => 'Products', 'value' => Product::count(), 'icon' => 'bi-cpu'],
            ['label' => 'Orders', 'value' => $ordersCount, 'icon' => 'bi-bag-check'],
            ['label' => 'Pending Orders', 'value' => Order::where('status', 'Pending')->count(), 'icon' => 'bi-hourglass-split'],
        ];

        $analytics = [
            ['label' => 'Total Revenue', 'value' => '$' . number_format((float) $totalRevenue, 2), 'icon' => 'bi-cash-stack'],
            ['label' => 'Average Order Value', 'value' => '$' . number_format($ordersCount ? ((float) $totalRevenue / $ordersCount) : 0, 2), 'icon' => 'bi-graph-up-arrow'],
            ['label' => 'Low Stock Products', 'value' => Product::where('stock_quantity', '<=', 5)->count(), 'icon' => 'bi-exclamation-triangle'],
            ['label' => 'Available Products', 'value' => Product::where('status', 'Available')->count(), 'icon' => 'bi-check-circle'],
        ];

        $orderStatuses = ['Pending', 'Confirmed', 'Processing', 'Shipped', 'Delivered', 'Cancelled', 'Returned'];
        $statusSummary = collect($orderStatuses)->map(function ($status) {
            return [
                'status' => $status,
                'count' => Order::where('status', $status)->count(),
            ];
        });

        $latestProducts = Product::with('category')->latest()->take(5)->get();
        $latestOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'analytics', 'statusSummary', 'latestProducts', 'latestOrders'));
    }
}
