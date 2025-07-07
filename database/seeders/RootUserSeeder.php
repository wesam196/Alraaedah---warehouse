<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RootUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::updateOrCreate(
            ['email' => config('auth.root.email')],   // lookup key
            [
                'name'     => 'Root',
                'password' => Hash::make(config('auth.root.password')),
                'usertype'     => 2,                      // 1 = admin (your own convention)
            ]
        );
    }
}
