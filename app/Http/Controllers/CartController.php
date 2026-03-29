<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    /**
     * Get the current user's cart instance ID.
     */
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

        return view('frontend.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id'
        ]);

        $asset = Asset::findOrFail($request->asset_id);

        if ($asset->is_free) {
            return response()->json([
                'status' => 'error',
                'message' => 'Free assets should be downloaded directly.'
            ], 400);
        }

        $cartId = $this->getCartId();
        $cart = Cart::session($cartId);

        // Check if item already exists
        if ($cart->has($asset->id)) {
            return response()->json([
                'status' => 'exists',
                'message' => 'Item is already in your cart.',
                'total_items' => $cart->getTotalQuantity()
            ]);
        }

        $cart->add([
            'id' => $asset->id,
            'name' => $asset->title,
            'price' => $asset->price,
            'quantity' => 1,
            'attributes' => [
                'type' => $asset->type,
                'thumbnail' => $asset->thumbnail,
                'slug' => $asset->slug
            ]
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Item added to cart.',
            'total_items' => $cart->getTotalQuantity()
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'row_id' => 'required'
        ]);

        $cartId = $this->getCartId();
        Cart::session($cartId)->remove($request->row_id);

        return response()->json([
            'status' => 'success',
            'message' => 'Item removed from cart.',
            'total_items' => Cart::session($cartId)->getTotalQuantity(),
            'cart_total' => Cart::session($cartId)->getTotal()
        ]);
    }

    public function clear()
    {
        $cartId = $this->getCartId();
        Cart::session($cartId)->clear();

        return redirect()->back()->with('success', 'Cart cleared.');
    }
}
