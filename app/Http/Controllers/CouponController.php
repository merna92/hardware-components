<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function apply(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255'],
        ]);

        if ($this->subtotal() <= 0) {
            return back()->withErrors(['coupon' => 'Add an item to your cart before applying a coupon.']);
        }

        $code = strtoupper(trim($validated['code']));
        $coupon = Coupon::query()->usable()->where('code', $code)->first();

        if (! $coupon) {
            return back()->withErrors(['coupon' => 'This coupon is invalid, inactive, or expired.']);
        }

        session(['coupon_code' => $coupon->code]);

        return back()->with('success', "Coupon {$coupon->code} applied.");
    }

    public function remove(): RedirectResponse
    {
        session()->forget('coupon_code');

        return back()->with('success', 'Coupon removed.');
    }

    private function subtotal(): float
    {
        if (!Auth::check()) {
            return 0;
        }

        $cart = Cart::query()
            ->where('user_id', Auth::id())
            ->where('status', 'Active')
            ->latest('id')
            ->first();

        return round((float) ($cart?->items()
            ->selectRaw('COALESCE(SUM(quantity * unit_price), 0) as subtotal')
            ->value('subtotal') ?? 0), 2);
    }
}
