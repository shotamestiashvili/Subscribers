<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'gross' => $this->faker->numberBetween(1, 1000),
            'net' => $this->faker->numberBetween(1, 1000),
            'description' => $this->faker->text
        ];
    }
}
