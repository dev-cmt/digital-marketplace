<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.asset'])
            ->latest()
            ->paginate(20);

        return view('backend.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.asset']);
        return view('backend.orders.show', compact('order'));
    }
}
