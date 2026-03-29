<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CheckoutController extends Controller
{
    private function getCartId()
    {
        if (auth()->check()) {
            return auth()->id();
        }

        if (!Session::has('cart_token')) {
            Session::put('cart_token', uniqid('guest_cart_'));
        }

        return Session::get('cart_token');
    }

    public function index()
    {
        $cartId = $this->getCartId();
        $cartItems = Cart::session($cartId)->getContent();
        $total = Cart::session($cartId)->getTotal();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        return view('frontend.checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $cartId = $this->getCartId();
        $cart = Cart::session($cartId);
        $cartItems = $cart->getContent();
        $total = $cart->getTotal();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Validate guest info if not logged in
        if (!\Auth::check()) {
            $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => 'nullable|string|max:20',
            ]);
        }

        // Create Order
        $order = Order::create([
            'user_id' => \Auth::id(),
            'customer_name' => \Auth::check() ? \Auth::user()->name : $request->customer_name,
            'customer_email' => \Auth::check() ? \Auth::user()->email : $request->customer_email,
            'customer_phone' => \Auth::check() ? (\Auth::user()->phone ?? null) : $request->customer_phone,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'status' => 'completed',
            'payment_method' => 'manual',
            'payment_status' => 'paid'
        ]);

        // Create Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'asset_id' => $item->id,
                'price' => $item->price
            ]);
        }

        // Clear Cart
        $cart->clear();

        return redirect()->route('checkout.success')->with('order_number', $order->order_number);
    }

    public function success()
    {
        return view('frontend.checkout.success');
    }
}
