<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'date' => $this->faker->dateTimeBetween($startDate = '2022-01-01', $endDate = '2040-12-31')->format('Y-m-d'),
            'time' => $this->faker->time('H:i'),
            'location' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 500), 
            'image' => 'https://picsum.photos/seed/picsum/1920/1080',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
