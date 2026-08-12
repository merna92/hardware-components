<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    private const TAX_RATE = 0.14;

    public function index(): View|RedirectResponse
    {
        $cart = $this->activeCart();

        if (! $cart || ! $cart->items()->exists()) {
            return redirect('/cart')->with('error', 'Your cart is empty.');
        }

        $items = $cart->items()->with('product')->get();

        return view('checkout.index', [
            'cartItems' => $items,
            'totals' => $this->totals($items),
            'coupon' => $this->coupon(),
            'user' => Auth::user(),
        ]);
    }

    public function store(CheckoutRequest $request): RedirectResponse
    {
        try {
            $order = DB::transaction(function () {
                $cart = Cart::query()
                    ->where('user_id', Auth::id())
                    ->where('status', 'Active')
                    ->lockForUpdate()
                    ->latest('id')
                    ->first();

                if (! $cart) {
                    throw new \RuntimeException('Your cart is empty.');
                }

                $items = $cart->items()->lockForUpdate()->get();

                if ($items->isEmpty()) {
                    throw new \RuntimeException('Your cart is empty.');
                }

                $products = Product::query()
                    ->whereIn('id', $items->pluck('product_id'))
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                foreach ($items as $item) {
                    $product = $products->get($item->product_id);

                    if (! $product || $product->stock_quantity < $item->quantity) {
                        throw new \RuntimeException("{$product?->product_name} no longer has enough stock.");
                    }
                }

                $coupon = $this->coupon();
                $totals = $this->totals($items, $coupon);
                $paymentMethod = $request->validated('payment_method');
                $paymentDetails = $request->validated('payment_details');

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'order_date' => now(),
                    'total_amount' => $totals['subtotal'],
                    'discount_amount' => $totals['discount'],
                    'shipping_fee' => 0,
                    'final_amount' => $totals['total'],
                    'status' => 'Pending',
                    'payment_status' => 'Unpaid',
                    'payment_method' => $paymentMethod,
                    'payment_details' => $paymentDetails,
                ]);

                foreach ($items as $item) {
                    $product = $products->get($item->product_id);
                    $lineTotal = round((float) $item->unit_price * $item->quantity, 2);

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'unit_price' => $item->unit_price,
                        'total_price' => $lineTotal,
                        'product_snapshot_name' => $product->product_name,
                    ]);

                    $product->decrement('stock_quantity', $item->quantity);
                }

                $cart->items()->delete();
                $cart->delete();
                session()->forget('coupon_code');

                return $order;
            });
        } catch (\RuntimeException $exception) {
            return redirect('/cart')->with('error', $exception->getMessage());
        }

        return redirect()->route('checkout.success', $order)->with('success', 'Order placed successfully.');
    }

    public function success(Order $order): View
    {
        abort_unless($order->user_id === Auth::id(), 404);

        return view('checkout.success', compact('order'));
    }

    private function activeCart(): ?Cart
    {
        if (!Auth::check()) {
            return null;
        }

        return Cart::query()
            ->where('user_id', Auth::id())
            ->where('status', 'Active')
            ->latest('id')
            ->first();
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

    private function totals(iterable $items, ?Coupon $coupon = null): array
    {
        $subtotal = round(collect($items)->sum(
            fn ($item) => (float) $item->unit_price * $item->quantity
        ), 2);
        $coupon ??= $this->coupon();
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
