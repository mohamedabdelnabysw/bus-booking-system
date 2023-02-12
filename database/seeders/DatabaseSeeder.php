<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Station::factory(20)->create();
        \App\Models\Bus::factory(2)->create([
            'seats_count' => 12
        ]);
        $this->call([
            TripSeeder::class
        ]);
    }
}
