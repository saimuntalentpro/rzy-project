<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'   => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
            'price' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'description' => $this->faker->paragraph(10, false),
            'status'  => $this->faker->randomElement(['Published', 'Draft'])
        ];
    }
}
