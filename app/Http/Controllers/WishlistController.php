<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist items.
     */
    public function index()
    {
        $wishlists = auth()->user()->wishlists()->with('product')->latest()->get();
        return view('profile.wishlist', compact('wishlists'));
    }

    /**
     * Add or remove a product from the wishlist (Toggle feature).
     */
    public function toggle(Request $request, $productId)
    {
        $userId = auth()->id();

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Product removed from your wishlist!');
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return redirect()->back()->with('success', 'Product added to your wishlist!');
    }

    /**
     * Remove an item from the wishlist page.
     */
    public function destroy($id)
    {
        $wishlist = auth()->user()->wishlists()->findOrFail($id);
        $wishlist->delete();

        return redirect()->back()->with('success', 'Item removed from wishlist successfully!');
    }
}