<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User Seeder
        $credentials = [
            'name' => 'Dummy User',
            'email' => 'dummy.user@mailnesia.com',
            'email_verified_at' => now(),
            'password' => Hash::make('dummypassword321!'),
        ];
        User::firstOrCreate($credentials);
    }
}
