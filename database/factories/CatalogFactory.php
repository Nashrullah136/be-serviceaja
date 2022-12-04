<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog>
 */
class CatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'image' => '',
            'number_series' => fake()->bothify('??######?'),
            'price' => fake()->numerify('#####'),
            'category' => 'SERVICE'
        ];
    }

    public function oli()
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => 'OLI'
            ];
        });
    }

    public function sparepart()
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => 'SPAREPART'
            ];
        });
    }
}
