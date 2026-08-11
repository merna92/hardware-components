<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WishlistController;
use App\Models\Address;
use App\Models\PaymentMethod;
use Illuminate\Validation\Rule;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{product}', [CatalogController::class, 'show'])->name('catalog.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // 👤 Profile Main Page Route (Fixes 'Route [profile] not defined')
    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile');

    // Update Profile Information
     Route::post('/profile/update', function (Request $request) {
    $user = auth()->user();

    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name'  => ['required', 'string', 'max:255'],
        'email'      => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'phone'      => ['nullable', 'string', 'regex:/^(010|011|012|015)[0-9]{8}$/'],
        'address'    => ['nullable', 'string', 'max:500'],
    ], [
        'phone.regex' => 'Please enter a valid Egyptian mobile number (e.g. 01012345678).',
    ]);

    $user->update([
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'email'      => $request->email,
        'phone'      => $request->phone,
        'address'    => $request->address,
    ]);

    return redirect()->back()->with('success', 'Profile updated successfully!');
})->name('profile.update');

    // Wishlist Routes
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{productId}', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{id}', [\App\Http\Controllers\WishlistController::class, 'destroy'])->name('wishlist.destroy');
            
            // Logout Route
        Route::post('/logout', function (Request $request) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('success', 'Logged out successfully!');
        })->name('logout');


    // 1️⃣ Display Payment Options Page (GET)
    Route::get('/payments', function () {
        $methods = auth()->user()->paymentMethods()->latest()->get();
        return view('profile.payments', compact('methods'));
    })->name('payments.index');

    // 2️⃣ Store Payment Method with Custom Validation Logic (POST)
    Route::post('/payments', function (Request $request) {
        $type = $request->input('type');

        $rules = [
            'type' => ['required', 'string'],
            'account_details' => ['required', 'string'],
        ];

        $messages = [];

        switch ($type) {
            case 'Vodafone Cash':
                $rules['account_details'][] = 'regex:/^010[0-9]{8}$/';
                $messages['account_details.regex'] = 'Vodafone Cash number must start with 010 and consist of 11 digits.';
                break;

            case 'Etisalat Cash':
                $rules['account_details'][] = 'regex:/^011[0-9]{8}$/';
                $messages['account_details.regex'] = 'Etisalat Cash number must start with 011 and consist of 11 digits.';
                break;

            case 'Orange Cash':
                $rules['account_details'][] = 'regex:/^012[0-9]{8}$/';
                $messages['account_details.regex'] = 'Orange Cash number must start with 012 and consist of 11 digits.';
                break;

            case 'InstaPay':
                $rules['account_details'][] = 'regex:/^(01[0125][0-9]{8}|[a-zA-Z0-9._-]+@instapay)$/';
                $messages['account_details.regex'] = 'Enter a valid 11-digit mobile number or InstaPay IPA address (e.g. username@instapay).';
                break;

            case 'PayPal':
                $rules['account_details'][] = 'email';
                $messages['account_details.email'] = 'Please enter a valid PayPal email address.';
                break;

            case 'Fawry':
                $rules['account_details'][] = 'regex:/^[0-9]{9,12}$/';
                $messages['account_details.regex'] = 'Fawry code/number must contain between 9 and 12 digits.';
                break;

            case 'Credit/Debit Card':
            case 'Bank Card':
                $rules['account_details'][] = 'regex:/^[0-9]{16}$/';
                $messages['account_details.regex'] = 'Card number must be exactly 16 digits.';
                break;
        }

        $request->validate($rules, $messages);

        auth()->user()->paymentMethods()->create([
            'type' => $type,
            'account_details' => $request->account_details,
        ]);

        return redirect()->back()->with('success', $type . ' account added successfully!');
    })->name('payments.store');

    // 3️⃣ Delete Payment Method (DELETE)
    Route::delete('/payments/{id}', function ($id) {
        $method = auth()->user()->paymentMethods()->findOrFail($id);
        $method->delete();

        return redirect()->back()->with('success', 'Payment option deleted successfully!');
    })->name('payments.destroy');

    // Update Profile Picture Only
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

    // My Orders Page
    Route::get('/orders', function () {
        $orders = auth()->user()->orders()->with('items')->latest()->get();
        return view('profile.orders', compact('orders'));
    })->name('orders.index');

    // Display Returned Orders Page
    Route::get('/returns', function () {
        $returns = auth()->user()->orders()
            ->whereIn('status', ['returned', 'refunded', 'return_requested'])
            ->with('items.product')
            ->latest()
            ->get();

        return view('profile.returns', compact('returns'));
    })->name('returns.index');

    // Display Cancelled Orders Page
    Route::get('/cancellations', function () {
        $cancellations = auth()->user()->orders()
            ->where('status', 'cancelled')
            ->with('items.product')
            ->latest()
            ->get();

        return view('profile.cancellations', compact('cancellations'));
    })->name('cancellations.index');

    // Display Addresses
    Route::get('/addresses', function () {
        $addresses = auth()->user()->addresses()->latest()->get();
        return view('profile.addresses', compact('addresses'));
    })->name('addresses.index');

    // Store New Address
    Route::post('/addresses', function (Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        auth()->user()->addresses()->create([
            'title' => $request->title,
            'city' => $request->city,
            'phone' => $request->phone,
            'details' => $request->details,
        ]);

        return redirect()->back()->with('success', 'New address added successfully!');
    })->name('addresses.store');

    // Delete Address
    Route::delete('/addresses/{id}', function ($id) {
        $address = auth()->user()->addresses()->findOrFail($id);
        $address->delete();

        return redirect()->back()->with('success', 'Address deleted successfully!');
    })->name('addresses.destroy');

});