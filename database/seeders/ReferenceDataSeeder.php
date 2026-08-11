<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferenceDataSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $categories = [
            'Graphics Card', 'Processor', 'RAM', 'Motherboard', 'Storage',
            'Power Supply', 'Case', 'Cooling System', 'Monitor', 'Keyboard',
            'Mouse', 'Accessories',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['category_name' => $category],
                ['description' => $category . ' products', 'created_at' => $now, 'updated_at' => $now]
            );
        }

        $brands = ['Intel', 'AMD', 'NVIDIA', 'ASUS', 'MSI', 'Gigabyte', 'Corsair', 'Kingston', 'Samsung', 'Western Digital'];

        foreach ($brands as $brand) {
            DB::table('brands')->updateOrInsert(
                ['brand_name' => $brand],
                ['created_at' => $now, 'updated_at' => $now]
            );
        }
    }
}
