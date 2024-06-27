<?php

namespace Database\Factories;

use App\Models\Actor;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'deadline_at' => fake()->date(),
            'return_date_at' => fake()->date(),
            'actual_date_at' => fake()->date(),
            'user_id' => User::all()->random()->id,
        ];
    }

}
