<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/locale/{locale}', [\App\Http\Controllers\LocaleController::class, 'setLocale'])->name('locale.set');
Route::get('/test-locale', function () {
    return 'Session locale: ' . session('locale') . ' | App locale: ' . app()->getLocale();
});
Route::get('/', [CatalogController::class, 'home'])->name('home');
Route::get('/welcome', [CatalogController::class, 'home'])->name('welcome');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/products', [CatalogController::class, 'index'])->name('products.index');
Route::get('/catalog/{product}', [CatalogController::class, 'show'])->name('catalog.show');
Route::get('/products/{product}', [CatalogController::class, 'show'])->name('products.show');

Route::get('/about', fn () => view('about'))->name('about');
Route::get('/contact', fn () => view('contact'))->name('contact');

/*
|--------------------------------------------------------------------------
| Guest Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Customers & Admins)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile Main Page
    Route::get('/profile', fn () => view('profile.index'))->name('profile');

    // Update Profile Info
    Route::post('/profile/update', function (Request $request) {
        $user = auth()->user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => trim($request->first_name . ' ' . $request->last_name),
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_number' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    })->name('profile.update');

    // Update Avatar
    Route::post('/profile/avatar', function (Request $request) {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    })->name('profile.avatar.update');

    // Wishlist Routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/items/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/items/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Coupons
    Route::post('/coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');
    Route::delete('/coupon/remove', [CouponController::class, 'remove'])->name('coupon.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Account Sub-pages
    Route::get('/orders', function () {
        $orders = auth()->user()->orders()->with('items')->latest()->get();
        return view('profile.orders', compact('orders'));
    })->name('orders.index');

    // Cancel an order (only if Pending)
    Route::post('/orders/{order}/cancel', function (\App\Models\Order $order) {
        abort_unless($order->user_id === auth()->id(), 403);
        abort_unless($order->status === 'Pending', 403, 'Only pending orders can be cancelled.');

        // Restore stock
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
        }

        $order->update(['status' => 'Cancelled']);
        return redirect()->back()->with('success', "Order #{$order->id} has been cancelled.");
    })->name('orders.cancel');

    // Request a return (only if Delivered)
    Route::post('/orders/{order}/return', function (\App\Models\Order $order) {
        abort_unless($order->user_id === auth()->id(), 403);
        abort_unless($order->status === 'Delivered', 403, 'Only delivered orders can be returned.');

        $order->update(['status' => 'Return Requested']);
        return redirect()->back()->with('success', "Return request for Order #{$order->id} has been submitted.");
    })->name('orders.return');

    Route::get('/returns', function () {
        $orders = auth()->user()->orders()->with('items')
            ->whereIn('status', ['Return Requested', 'Returned'])
            ->latest()->get();
        return view('profile.returns', compact('orders'));
    })->name('returns.index');

    Route::get('/cancellations', function () {
        $orders = auth()->user()->orders()->with('items')
            ->where('status', 'Cancelled')
            ->latest()->get();
        return view('profile.cancellations', compact('orders'));
    })->name('cancellations.index');

    // Addresses
    Route::get('/addresses', function () {
        $addresses = auth()->user()->addresses()->latest()->get();
        return view('profile.addresses', compact('addresses'));
    })->name('addresses.index');

    Route::post('/addresses', function (Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        auth()->user()->addresses()->create($request->only(['title', 'city', 'phone', 'details']));

        return redirect()->back()->with('success', 'New address added successfully!');
    })->name('addresses.store');

    Route::delete('/addresses/{id}', function ($id) {
        $address = auth()->user()->addresses()->findOrFail($id);
        $address->delete();

        return redirect()->back()->with('success', 'Address deleted successfully!');
    })->name('addresses.destroy');

    // Payments
    Route::get('/payments', function () {
        $methods = auth()->user()->paymentMethods()->latest()->get();
        return view('profile.payments', compact('methods'));
    })->name('payments.index');

    Route::post('/payments', function (Request $request) {
        $request->validate([
            'type' => ['required', 'string'],
            'account_details' => ['required', 'string'],
        ]);

        auth()->user()->paymentMethods()->create($request->only(['type', 'account_details']));

        return redirect()->back()->with('success', 'Payment option added successfully!');
    })->name('payments.store');

    Route::delete('/payments/{id}', function ($id) {
        $method = auth()->user()->paymentMethods()->findOrFail($id);
        $method->delete();

        return redirect()->back()->with('success', 'Payment option deleted successfully!');
    })->name('payments.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Management Routes (Protected by AdminMiddleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware([AdminMiddleware::class])->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // User Management (Gerges)
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Coupon Management (Gerges)
    Route::get('/coupons', [AdminController::class, 'coupons'])->name('coupons.index');
    Route::get('/coupons/create', [AdminController::class, 'createCoupon'])->name('coupons.create');
    Route::post('/coupons', [AdminController::class, 'storeCoupon'])->name('coupons.store');
    Route::get('/coupons/{coupon}/edit', [AdminController::class, 'editCoupon'])->name('coupons.edit');
    Route::patch('/coupons/{coupon}', [AdminController::class, 'updateCoupon'])->name('coupons.update');
    Route::delete('/coupons/{coupon}', [AdminController::class, 'deleteCoupon'])->name('coupons.delete');

    // Category Management (Mirna)
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    // Product Management (Mirna)
    Route::resource('products', AdminProductController::class)->except(['show']);

    // Order Management (Mirna)
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
});
