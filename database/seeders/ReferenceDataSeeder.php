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

        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone_number' => '01000000000',
                'role_type' => 'Admin',
            ],
            [
                'first_name' => 'Demo',
                'last_name' => 'Customer',
                'name' => 'Demo Customer',
                'email' => 'customer@example.com',
                'phone_number' => '01111111111',
                'role_type' => 'Customer',
            ],
            [
                'first_name' => 'Support',
                'last_name' => 'Agent',
                'name' => 'Support Agent',
                'email' => 'support@example.com',
                'phone_number' => '01222222222',
                'role_type' => 'Support_Agent',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                $user + [
                    'password' => Hash::make('password'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

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
