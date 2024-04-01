<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // Create 100 admins
        User::factory()->count(100)->create()->each(function ($user) use ($adminRole) {
            $user->assignRole($adminRole);
        });

        // Create 10,000 users
        User::factory()->count(9900)->create()->each(function ($user) use ($userRole) {
            $user->assignRole($userRole);
        });
    }
}
