<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Text;
use App\Models\Title;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@example.com',
             'password' => Hash::make('12345678')
         ]);

         Title::factory()->count(3)->create([
             'title' => fake()->realText(100)
         ]);

         Text::factory()->count(5)->create();


    }
}
