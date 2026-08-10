<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        $coupons = [
            ['code' => 'WELCOME10', 'type' => 'Percentage', 'value' => 10, 'usage_limit' => 100, 'status' => 'Active'],
            ['code' => 'HARDWARE500', 'type' => 'Fixed_Amount', 'value' => 500, 'usage_limit' => 50, 'status' => 'Active'],
            ['code' => 'COMING20', 'type' => 'Percentage', 'value' => 20, 'usage_limit' => 25, 'status' => 'Scheduled'],
        ];

        foreach ($coupons as $coupon) {
            DB::table('coupons')->updateOrInsert(
                ['code' => $coupon['code']],
                $coupon + [
                    'used_count' => 0,
                    'start_date' => now()->toDateString(),
                    'end_date' => now()->addMonth()->toDateString(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
