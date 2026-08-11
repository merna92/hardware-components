<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::query()->updateOrCreate(
            ['code' => 'SAVE10'],
            [
                'type' => 'percent',
                'value' => 10,
                'expires_at' => null,
                'is_active' => true,
            ]
        );

        Coupon::query()->updateOrCreate(
            ['code' => 'FLAT20'],
            [
                'type' => 'fixed',
                'value' => 20,
                'expires_at' => null,
                'is_active' => true,
            ]
        );
    }
}
