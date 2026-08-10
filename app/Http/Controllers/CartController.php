<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    private const TAX_RATE = 0.14;

    public function index(): View
    {
        $cart = $this->activeCart();
        $items = $cart?->items()->with('product')->get() ?? collect();

        $totals = $this->totals($items);

        return view('cart.index', [
            'cartItems' => $items,
            'totals' => $totals,
            'coupon' => $this->coupon(),
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $item = $this->ownedItem($id);

        abort_unless($item, 404);

        if (! $item->product || $validated['quantity'] > $item->product->stock_quantity) {
            return back()->withErrors([
                'quantity' => "Only {$item->product?->stock_quantity} item(s) are available for {$item->product?->product_name}.",
            ]);
        }

        $item->update(['quantity' => $validated['quantity']]);

        return back()->with('success', 'Cart updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $item = $this->ownedItem($id);

        abort_unless($item, 404);

        $item->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    public function clear(): RedirectResponse
    {
        $cart = $this->activeCart();

        if ($cart) {
            $cart->items()->delete();
        }

        return back()->with('success', 'Cart cleared.');
    }

    private function activeCart(): ?Cart
    {
        return Cart::query()
            ->where('user_id', $this->userId())
            ->where('status', 'Active')
            ->latest('id')
            ->first();
    }

    private function ownedItem(int $id): ?CartItem
    {
        return CartItem::query()
            ->with('product')
            ->whereKey($id)
            ->whereHas('cart', fn ($query) => $query
                ->where('user_id', $this->userId())
                ->where('status', 'Active'))
            ->first();
    }

    private function userId(): int
    {
        return Auth::id() ?? (int) \App\Models\User::query()
            ->where('email', 'test@example.com')
            ->value('id');
    }

    private function coupon(): ?Coupon
    {
        $code = session('coupon_code');

        if (! $code) {
            return null;
        }

        $coupon = Coupon::query()->usable()->where('code', $code)->first();

        if (! $coupon) {
            session()->forget('coupon_code');
        }

        return $coupon;
    }

    private function totals(iterable $items): array
    {
        $subtotal = round(collect($items)->sum(
            fn (CartItem $item) => (float) $item->unit_price * $item->quantity
        ), 2);
        $coupon = $this->coupon();
        $discount = $coupon?->discountFor($subtotal) ?? 0;
        $tax = round(($subtotal - $discount) * self::TAX_RATE, 2);

        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'total' => round($subtotal - $discount + $tax, 2),
        ];
    }
}
