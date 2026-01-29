<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Create default super admin: super@admin.com / password@143
     */
    public function run(): void
    {
        if (User::where('email', 'super@admin.com')->exists()) {
            return;
        }

        User::create([
            'name'     => 'Super Admin',
            'email'    => 'super@admin.com',
            'password' => Hash::make('password@143'),
            'role'     => User::ROLE_SUPER_ADMIN,
        ]);
    }
}
