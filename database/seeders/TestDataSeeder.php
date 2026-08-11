<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Mock Users
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Owner',
                'name' => 'Admin Owner',
                'phone_number' => '01234567890',
                'role_type' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $customer = User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'name' => 'John Doe',
                'phone_number' => '09876543210',
                'role_type' => 'Customer',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Retrieve Categories
        $graphicsCardCat = Category::where('category_name', 'Graphics Card')->first();
        $processorCat = Category::where('category_name', 'Processor')->first();
        $ramCat = Category::where('category_name', 'RAM')->first();
        $motherboardCat = Category::where('category_name', 'Motherboard')->first();
        $storageCat = Category::where('category_name', 'Storage')->first();
        $psuCat = Category::where('category_name', 'Power Supply')->first();
        $caseCat = Category::where('category_name', 'Case')->first();
        $monitorCat = Category::where('category_name', 'Monitor')->first();

        // 3. Create realistic Products
        $p1 = Product::updateOrCreate(
            ['product_name' => 'NVIDIA GeForce RTX 4070 Ti'],
            [
                'category_id' => $graphicsCardCat->id,
                'description' => 'High performance graphics card with 12GB GDDR6X memory, DLSS 3 support.',
                'price' => 799.99,
                'stock_quantity' => 15,
                'warranty_period' => '3 Years',
                'release_date' => '2023-01-05',
                'status' => 'Available',
            ]
        );

        $p2 = Product::updateOrCreate(
            ['product_name' => 'AMD Ryzen 7 7800X3D'],
            [
                'category_id' => $processorCat->id,
                'description' => 'The ultimate gaming processor with 3D V-Cache technology, 8 cores, 16 threads.',
                'price' => 369.99,
                'stock_quantity' => 8,
                'warranty_period' => '3 Years',
                'release_date' => '2023-04-06',
                'status' => 'Available',
            ]
        );

        $p3 = Product::updateOrCreate(
            ['product_name' => 'Corsair Vengeance DDR5 32GB (2x16GB) 6000MHz'],
            [
                'category_id' => $ramCat->id,
                'description' => 'High speed DDR5 desktop memory with onboard voltage regulation and XMP 3.0 profiles.',
                'price' => 115.00,
                'stock_quantity' => 24,
                'warranty_period' => 'Lifetime',
                'release_date' => '2022-10-12',
                'status' => 'Available',
            ]
        );

        $p4 = Product::updateOrCreate(
            ['product_name' => 'ASUS ROG STRIX B650-A Gaming WiFi'],
            [
                'category_id' => $motherboardCat->id,
                'description' => 'AMD AM5 motherboard with PCIe 5.0 support, robust power design, and white/silver aesthetics.',
                'price' => 229.99,
                'stock_quantity' => 5, // low stock
                'warranty_period' => '3 Years',
                'release_date' => '2022-11-01',
                'status' => 'Available',
            ]
        );

        $p5 = Product::updateOrCreate(
            ['product_name' => 'Samsung 990 PRO 2TB NVMe M.2 SSD'],
            [
                'category_id' => $storageCat->id,
                'description' => 'PCIe Gen 4.0 NVMe internal SSD, read speeds up to 7450 MB/s.',
                'price' => 179.99,
                'stock_quantity' => 3, // low stock
                'warranty_period' => '5 Years',
                'release_date' => '2022-11-22',
                'status' => 'Available',
            ]
        );

        $p6 = Product::updateOrCreate(
            ['product_name' => 'Corsair RM850x 850W 80+ Gold'],
            [
                'category_id' => $psuCat->id,
                'description' => 'Fully modular power supply with magnetic levitation fan, ultra-low noise.',
                'price' => 124.99,
                'stock_quantity' => 12,
                'warranty_period' => '10 Years',
                'release_date' => '2021-04-15',
                'status' => 'Available',
            ]
        );

        $p7 = Product::updateOrCreate(
            ['product_name' => 'Lian Li PC-O11 Dynamic EVO'],
            [
                'category_id' => $caseCat->id,
                'description' => 'Dual-chamber mid-tower chassis with modular layout and seamless tempered glass.',
                'price' => 159.99,
                'stock_quantity' => 0, // out of stock
                'warranty_period' => '1 Year',
                'release_date' => '2022-02-05',
                'status' => 'Out_Of_Stock',
            ]
        );

        $p8 = Product::updateOrCreate(
            ['product_name' => 'ASUS TUF Gaming 27" 1440p 170Hz Monitor'],
            [
                'category_id' => $monitorCat->id,
                'description' => 'IPS gaming monitor with extreme low motion blur, G-SYNC compatible, HDR10.',
                'price' => 299.99,
                'stock_quantity' => 7,
                'warranty_period' => '3 Years',
                'release_date' => '2021-09-10',
                'status' => 'Available',
            ]
        );

        // 4. Create Mock Orders

        // Order 1: Delivered (RTX 4070 Ti + Ryzen 7800X3D)
        $o1 = Order::create([
            'user_id' => $customer->id,
            'order_date' => now()->subDays(5),
            'total_amount' => 1169.98,
            'discount_amount' => 0.00,
            'shipping_fee' => 15.00,
            'final_amount' => 1184.98,
            'status' => 'Delivered',
            'payment_status' => 'Paid',
        ]);

        OrderItem::create([
            'order_id' => $o1->id,
            'product_id' => $p1->id,
            'quantity' => 1,
            'unit_price' => 799.99,
            'total_price' => 799.99,
            'product_snapshot_name' => $p1->product_name,
        ]);

        OrderItem::create([
            'order_id' => $o1->id,
            'product_id' => $p2->id,
            'quantity' => 1,
            'unit_price' => 369.99,
            'total_price' => 369.99,
            'product_snapshot_name' => $p2->product_name,
        ]);

        // Order 2: Pending (ASUS Monitor)
        $o2 = Order::create([
            'user_id' => $customer->id,
            'order_date' => now()->subHours(12),
            'total_amount' => 299.99,
            'discount_amount' => 0.00,
            'shipping_fee' => 15.00,
            'final_amount' => 314.99,
            'status' => 'Pending',
            'payment_status' => 'Unpaid',
        ]);

        OrderItem::create([
            'order_id' => $o2->id,
            'product_id' => $p8->id,
            'quantity' => 1,
            'unit_price' => 299.99,
            'total_price' => 299.99,
            'product_snapshot_name' => $p8->product_name,
        ]);

        // Order 3: Shipped (Corsair RAM x2 + Samsung SSD)
        $o3 = Order::create([
            'user_id' => $customer->id,
            'order_date' => now()->subDays(2),
            'total_amount' => 409.99,
            'discount_amount' => 10.00,
            'shipping_fee' => 15.00,
            'final_amount' => 414.99,
            'status' => 'Shipped',
            'payment_status' => 'Paid',
        ]);

        OrderItem::create([
            'order_id' => $o3->id,
            'product_id' => $p3->id,
            'quantity' => 2,
            'unit_price' => 115.00,
            'total_price' => 230.00,
            'product_snapshot_name' => $p3->product_name,
        ]);

        OrderItem::create([
            'order_id' => $o3->id,
            'product_id' => $p5->id,
            'quantity' => 1,
            'unit_price' => 179.99,
            'total_price' => 179.99,
            'product_snapshot_name' => $p5->product_name,
        ]);
    }
}
