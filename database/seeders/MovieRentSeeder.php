<?php

namespace Database\Seeders;

use App\Models\ActorMovie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieRentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActorMovie::factory()->times(50)->create();
    }
}
