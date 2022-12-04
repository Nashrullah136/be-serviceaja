<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'body' => fake()->text(),
            'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/10/c4/23/16/highland-view-bed-and.jpg',
            'category' => 'OTOMOTIF'
        ];
    }

    public function otomotif()
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => 'OTOMOTIF'
            ];
        });
    }

    public function service()
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => 'SERVICE'
            ];
        });
    }
}
