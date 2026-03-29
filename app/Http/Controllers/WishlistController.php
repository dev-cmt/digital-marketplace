<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with(['asset', 'asset.category'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('frontend.wishlist.index', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id'
        ]);

        $userId = Auth::id();
        $assetId = $request->asset_id;

        $wishlist = Wishlist::where('user_id', $userId)->where('asset_id', $assetId)->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Asset removed from wishlist'
            ]);
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'asset_id' => $assetId
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Asset added to wishlist'
            ]);
        }
    }
}
