<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create();
        User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => $password = Hash::make('password'),
            'remember_token' => Str::random(10),
            'permissions' => '1',
        ]);
    }
}
