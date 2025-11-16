<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'ref_no' => 'USER-' . date('Ymd') . '-' . rand(10000, 99999),
            'user_name' => 'admin',
            'name' => 'Admin',
            'password' => Hash::make('admin1234'),
            'user_type' => 'admin',
        ]);

        // Check Add
        User::create([
            'ref_no' => 'USER-' . date('Ymd') . '-' . rand(10000, 99999),
            'user_name' => 'checkadd',
            'name' => 'Checkadd',
            'password' => Hash::make('checkadd1234'),
            'user_type' => 'check-add',
        ]);

        // Check Release
        User::create([
            'ref_no' => 'USER-' . date('Ymd') . '-' . rand(10000, 99999),
            'user_name' => 'checkrelease',
            'name' => 'Checkrelease',
            'password' => Hash::make('checkrelease1234'),
            'user_type' => 'check-release',
        ]);
    }

}
