<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Da Vuthea',
            'email' => 'da.vuthea@nubb.edu.kh',
            'password' => Hash::make('Vuthea@123'),
            'role' => 'admin',
        ]);
    }
}
