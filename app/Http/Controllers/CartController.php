<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(){
        // $userId = Auth::id();
        $userId = 4;
        $cart = Cart::where('user_id', $userId)->first();
        $sum = $cart ? $cart->items()->sum(DB::raw('unit_price * quantity')) : 0;
        $cartItems = CartItem::whereHas('cart', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    })->with('product')->get();

        return view('cart.cart',[
            'cartItems'=> $cartItems,
            'sum' => $sum,
        ]);
    }

    public function destroy(Request $request){
        // $userId = Auth::id();
        $userId = 4;
        $deleted = CartItem::where('id', $request->item_id)
        ->whereHas('cart', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->delete();

        if (!$deleted) {
            abort(404);
        }

        return redirect()->back()->with('success','the item deleted successfully');
    }
}
