<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Young',
            'email' => 'young@test.com',
            'password' => Hash::make('QAZzaq123'),
        ]);

        User::create([
            'name' => 'Willy',
            'email' => 'willy@test.com',
            'password' => Hash::make('QAZzaq123'),
        ]);

        User::create([
            'name' => 'Sadiki',
            'email' => 'sadiki@test.com',
            'password' => Hash::make('QAZzaq123'),
        ]);
    }
}
