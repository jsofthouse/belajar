<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Participant;
use App\Models\Training;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $participants = Participant::factory(40)->create();

        Training::factory(25)->create()->each(function ($training) use ($participants) {
            $training->participants()->attach(
                $participants->random(rand(0, 10))->pluck('id')
            );
        });
    }
}
