<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        User::create([
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'phone' => '09458761324',
            'address' => 'yangon',
            'role' => 'admin',
            'gender' =>'male',
            'password' => Hash::make('admin12345')
        ]);
    }
}
