<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Hkmt Ali',
            'email' => 'admin@gmail.com',
            'phone' => '07517065163',
            'password' => '151020019',
        ]);
    }
}
