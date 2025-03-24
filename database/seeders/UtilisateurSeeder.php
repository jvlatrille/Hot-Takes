<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => Hash::make('M0tDeP@sse!'),
        ]);

        User::create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => Hash::make('M0tDeP@sse!'),
        ]);

        User::create([
            'name' => 'Charlie',
            'email' => 'charlie@example.com',
            'password' => Hash::make('M0tDeP@sse!'),
        ]);
    }
}
