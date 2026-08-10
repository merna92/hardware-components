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

        // The brands table was intentionally removed from this team version.
        // Keep the reference seeder limited to the active schema.
    }
}
