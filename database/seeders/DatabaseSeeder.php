<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Merchant;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create merchant user
        $merchantUser = User::create([
            'name' => 'Katering Sejahtera',
            'email' => 'merchant@test.com',
            'password' => Hash::make('password'),
            'role' => 'merchant',
        ]);

        $merchant = Merchant::create([
            'user_id' => $merchantUser->id,
            'company_name' => 'Katering Sejahtera',
            'address' => 'Jl. Merdeka No. 123, Jakarta',
            'phone_number' => '081234567890',
            'description' => 'Katering terbaik untuk kebutuhan kantor Anda',
        ]);

        // Create some menus
        Menu::create([
            'merchant_id' => $merchant->id,
            'name' => 'Nasi Goreng Spesial',
            'description' => 'Nasi goreng dengan ayam dan telur',
            'price' => 25000,
        ]);

        Menu::create([
            'merchant_id' => $merchant->id,
            'name' => 'Ayam Bakar',
            'description' => 'Ayam bakar dengan nasi dan lalapan',
            'price' => 30000,
        ]);

        Menu::create([
            'merchant_id' => $merchant->id,
            'name' => 'Soto Ayam',
            'description' => 'Soto ayam dengan nasi',
            'price' => 20000,
        ]);

        // Create customer user
        User::create([
            'name' => 'PT Maju Jaya',
            'email' => 'customer@test.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}