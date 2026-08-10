<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $products = [
            ['AMD Ryzen 7 7800X3D Processor', 449.99],
            ['NVIDIA GeForce RTX 4070 Super', 599.99],
            ['Samsung 990 Pro 2TB NVMe SSD', 179.99],
            ['Corsair Vengeance 32GB DDR5 Kit', 124.99],
            ['ASUS TUF Gaming B650-PLUS WiFi', 219.99],
            ['Seasonic Focus GX-850 Power Supply', 149.99],
            ['NZXT H7 Flow Mid Tower Case', 129.99],
            ['Noctua NH-D15 CPU Cooler', 119.99],
            ['LG UltraGear 27 Inch QHD Monitor', 299.99],
            ['Logitech G Pro X Superlight Mouse', 139.99],
        ];
        [$name, $price] = $this->faker->unique()->randomElement($products);

        return [
            'category_id' => DB::table('categories')->inRandomOrder()->value('id'),
            'product_name' => $name,
            'description' => $this->faker->sentence(14),
            'price' => $price,
            'stock_quantity' => $this->faker->numberBetween(15, 75),
            'warranty_period' => $this->faker->randomElement(['12 months', '24 months', '36 months']),
            'image_url' => null,
            'release_date' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'status' => 'Available',
        ];
    }
}
