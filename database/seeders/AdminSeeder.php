<?php

namespace Database\Seeders;

use App\Constant\Level;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nanang Setyawan',
            'email' => 'nanang@gmail.com',
            'level' => Level::ADMIN,
            'password' => Hash::make('123456')
        ]);
    }
}
