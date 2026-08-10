<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ReferenceDataSeeder::class);

        $this->call(CouponSeeder::class);

        $user = User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        $products = Product::factory()->count(10)->create();
        $cart = Cart::create(['user_id' => $user->id, 'status' => 'Active']);

        foreach ($products->take(2) as $index => $product) {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $index + 1,
                'unit_price' => $product->price,
                'added_at' => now(),
            ]);
        }
    }
}
