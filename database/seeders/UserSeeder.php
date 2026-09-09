<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // 15 utilisateurs normaux
    User::factory(15)->create();


    // Admin
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'role' => 'admin',
        'remember_token' => Str::random(10),
    ]);

    // Agent 1
    User::create([
        'name' => 'Agent 1',
        'email' => 'agent1@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'role' => 'agent',
        'remember_token' => Str::random(10),
    ]);

    // Agent 2
    User::create([
        'name' => 'Agent 2',
        'email' => 'agent2@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'role' => 'agent',
        'remember_token' => Str::random(10),
    ]);

        // Agent 3
    User::create([
        'name' => 'Agent 3',
        'email' => 'agent3@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'role' => 'agent',
        'remember_token' => Str::random(10),
    ]);
    }
}
