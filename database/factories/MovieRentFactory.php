<?php

namespace Database\Factories;

use App\Models\Actor;
use App\Models\Movie;
use App\Models\Rent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActorMovie>
 */
class MovieRentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'movie_id' => Movie::all()->random()->id,
            'rent_id' => Rent::all()->random()->id,
        ];
    }
}
