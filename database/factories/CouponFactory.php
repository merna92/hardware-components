<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('????##')),
            'type' => $this->faker->randomElement(['fixed', 'percent']),
            'value' => $this->faker->randomFloat(2, 5, 50),
            'expires_at' => $this->faker->optional()->dateTimeBetween('+1 day', '+1 year'),
            'is_active' => true,
        ];
    }

    public function fixed(float $amount = 20): static
    {
        return $this->state(fn (): array => [
            'type' => 'fixed',
            'value' => $amount,
        ]);
    }

    public function percent(float $percentage = 10): static
    {
        return $this->state(fn (): array => [
            'type' => 'percent',
            'value' => $percentage,
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn (): array => [
            'expires_at' => now()->subDay(),
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (): array => [
            'is_active' => false,
        ]);
    }
}
