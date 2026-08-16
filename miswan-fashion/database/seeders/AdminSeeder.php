<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@miswanfashion.com'],
            [
                'name' => 'Miswan Super Admin',
                'email' => 'admin@miswanfashion.com',
                'phone' => '+8801700000001',
                'password' => Hash::make('Admin@123456'),
                'role' => 'super_admin',
                'status' => 1,
            ]
        );

        User::updateOrCreate(
            ['phone' => '01711112222'],
            [
                'name' => 'Demo Customer',
                'phone' => '01711112222',
                'email' => 'customer@example.com',
                'password' => Hash::make('Customer@123456'),
                'address' => 'House 10, Road 4, Dhanmondi, Dhaka',
                'district' => 'Dhaka',
                'upazila' => 'Dhaka Sadar',
                'status' => 1,
            ]
        );
    }
}
