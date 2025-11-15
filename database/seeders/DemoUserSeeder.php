<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::updateOrCreate(
            ['email' => 'customer@example.com'],
            ['name' => 'Demo Customer', 'password' => bcrypt('password')]
        );
        $customer->assignRole('customer');

        $staff = User::updateOrCreate(
            ['email' => 'staff@example.com'],
            ['name' => 'Demo Staff', 'password' => bcrypt('password')]
        );
        $staff->assignRole('staff');

        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Demo Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole('admin');
    }
}
