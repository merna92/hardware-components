<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

        // Brands table is currently disabled in the migration.
    }
}
