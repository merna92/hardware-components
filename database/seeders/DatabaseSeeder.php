<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // 1. Seed exactly ONE Admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'System',
                'last_name' => 'Admin',
                'name' => 'System Admin',
                'phone' => '01000000000',
                'phone_number' => '01000000000',
                'role' => 'admin',
                'role_type' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Seed 10 Random Customers
        $customers = User::factory()->count(10)->create([
            'role' => 'customer',
            'role_type' => 'Customer',
            'password' => Hash::make('password')
        ]);

        // 2. Create hardware categories
        $categories = [
            'Graphics Card' => 'High-performance GPUs for gaming, video editing, and AI workloads.',
            'Processor' => 'Intel Core and AMD Ryzen desktop processors.',
            'RAM' => 'DDR4 and DDR5 memory modules for desktop PCs.',
            'Motherboard' => 'Intel and AMD sockets motherboards.',
            'Storage' => 'M.2 NVMe SSDs and high-capacity hard drives.',
            'Power Supply' => '80+ Gold certified power supplies.',
            'Case' => 'Mid-tower and full-tower PC chassis.',
            'Monitor' => 'High refresh rate gaming and productivity monitors.',
        ];

        $catModels = [];
        foreach ($categories as $name => $desc) {
            $catModels[$name] = Category::firstOrCreate(
                ['category_name' => $name],
                ['description' => $desc]
            );
        }

        // 3. Realistic Hardware Products Generation
        $productNames = [
            'Graphics Card' => [
                'NVIDIA GeForce RTX 4090', 'NVIDIA GeForce RTX 4080 Super', 'NVIDIA GeForce RTX 4070 Ti', 
                'NVIDIA GeForce RTX 4060 Ti', 'NVIDIA GeForce RTX 3080', 'NVIDIA GeForce RTX 3060',
                'AMD Radeon RX 7900 XTX', 'AMD Radeon RX 7900 XT', 'AMD Radeon RX 7800 XT', 
                'AMD Radeon RX 7600', 'ASUS ROG Strix RTX 4090', 'MSI Suprim X RTX 4080'
            ],
            'Processor' => [
                'Intel Core i9-14900K', 'Intel Core i7-14700K', 'Intel Core i5-14600K',
                'Intel Core i9-13900K', 'Intel Core i7-13700K', 'Intel Core i5-13400F',
                'AMD Ryzen 9 7950X3D', 'AMD Ryzen 9 7900X', 'AMD Ryzen 7 7800X3D',
                'AMD Ryzen 5 7600X', 'AMD Ryzen 7 5800X3D', 'AMD Ryzen 5 5600X'
            ],
            'RAM' => [
                'Corsair Vengeance RGB DDR5 32GB 6000MHz', 'G.Skill Trident Z5 RGB 32GB 6400MHz',
                'Kingston Fury Beast DDR5 16GB 5200MHz', 'Crucial Pro DDR5 64GB 5600MHz',
                'TeamGroup T-Force Delta RGB 32GB 6000MHz', 'Corsair Dominator Platinum 64GB DDR5',
                'G.Skill Ripjaws V DDR4 32GB 3600MHz', 'Corsair Vengeance LPX DDR4 16GB 3200MHz'
            ],
            'Motherboard' => [
                'ASUS ROG Maximus Z790 Hero', 'MSI MAG Z790 Tomahawk WiFi', 'GIGABYTE Z790 AORUS Elite AX',
                'ASUS TUF Gaming B760-PLUS', 'ASRock B760M Steel Legend',
                'ASUS ROG Crosshair X670E Hero', 'MSI MPG B650 Carbon WiFi', 'GIGABYTE B650 AORUS Elite',
                'ASUS Prime B650-PLUS', 'ASRock X670E Taichi'
            ],
            'Storage' => [
                'Samsung 990 PRO 2TB NVMe SSD', 'WD Black SN850X 1TB NVMe SSD',
                'Crucial T700 2TB Gen5 NVMe SSD', 'Seagate FireCuda 530 2TB SSD',
                'Samsung 980 PRO 1TB SSD', 'Kingston KC3000 2TB PCIe 4.0 NVMe',
                'Seagate BarraCuda 2TB HDD', 'WD Blue 4TB HDD'
            ],
            'Power Supply' => [
                'Corsair RM850x 850W 80+ Gold', 'Seasonic FOCUS GX-1000 1000W 80+ Gold',
                'EVGA SuperNOVA 850 G6', 'Be Quiet! Dark Power 13 1000W',
                'Thermaltake Toughpower GF3 1200W', 'MSI MPG A850G PCIE5 850W',
                'Corsair CX750M 750W 80+ Bronze', 'Cooler Master MWE Gold 850 V2'
            ],
            'Case' => [
                'Lian Li O11 Dynamic EVO', 'Corsair 4000D Airflow', 'Fractal Design North',
                'NZXT H9 Flow', 'Phanteks NV7', 'Hyte Y60', 'Cooler Master MasterBox TD500',
                'Be Quiet! Pure Base 500DX', 'Corsair 5000D Airflow', 'Lian Li Lancool 216'
            ],
            'Monitor' => [
                'Alienware AW3423DW OLED', 'ASUS ROG Swift PG279QM', 'LG 27GR95QE-B OLED',
                'Samsung Odyssey G7 32"', 'Gigabyte M28U 4K', 'MSI Optix MAG274QRF-QD',
                'LG 27GP850-B', 'BenQ ZOWIE XL2566K', 'Acer Predator XB273K', 'Dell S2721DGF'
            ]
        ];

        $products = [];
        $imgCounter = 1;
        foreach ($productNames as $category => $items) {
            foreach ($items as $index => $item) {
                // Use loremflickr for actual real-world hardware photography
                $imageUrl = "https://loremflickr.com/400/400/computer,hardware,gpu?lock={$imgCounter}";
                $imgCounter++;
                
                $products[] = Product::firstOrCreate(
                    ['product_name' => $item],
                    [
                        'category_id' => $catModels[$category]->id,
                        'description' => "Premium {$category} - {$item}. High performance and reliability for your next PC build.",
                        'price' => $faker->randomFloat(2, 50, 2000),
                        'stock_quantity' => $faker->numberBetween(0, 50),
                        'warranty_period' => $faker->randomElement(['1 Year', '2 Years', '3 Years', '5 Years']),
                        'status' => 'Available',
                        'image_url' => $imageUrl
                    ]
                );
            }
        }

        // 4. Seed sample coupons
        Coupon::firstOrCreate(
            ['code' => 'SAVE10'],
            ['type' => 'Percentage', 'value' => 10.00, 'status' => 'Active', 'usage_limit' => 100]
        );
        Coupon::firstOrCreate(
            ['code' => 'WELCOME20'],
            ['type' => 'Fixed_Amount', 'value' => 20.00, 'status' => 'Active', 'usage_limit' => 50]
        );

        // 5. Seed Orders for Dashboard Statistics
        foreach (range(1, 40) as $i) {
            $user = $customers->random();
            
            // Randomly select 1 to 4 products for this order
            $orderProducts = $faker->randomElements($products, $faker->numberBetween(1, 4));
            
            $subtotal = 0;
            $items = [];
            foreach ($orderProducts as $product) {
                $qty = $faker->numberBetween(1, 2);
                $lineTotal = $product->price * $qty;
                $subtotal += $lineTotal;
                
                $items[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'unit_price' => $product->price,
                    'total_price' => $lineTotal,
                    'product_snapshot_name' => $product->product_name,
                ];
            }

            $tax = $subtotal * 0.14;
            $total = $subtotal + $tax;

            $order = Order::create([
                'user_id' => $user->id,
                'order_date' => $faker->dateTimeBetween('-6 months', 'now'),
                'total_amount' => $subtotal,
                'discount_amount' => 0,
                'shipping_fee' => 0,
                'final_amount' => $total,
                'status' => $faker->randomElement(['Pending', 'Processing', 'Completed', 'Completed', 'Completed', 'Cancelled']),
                'payment_status' => $faker->randomElement(['Paid', 'Paid', 'Unpaid']),
            ]);

            foreach ($items as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }
        }
    }
}
