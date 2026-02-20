<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'description' => 'Super Administrator with full system access',
            ],
            [
                'name' => 'admin',
                'description' => 'System Administrator',
            ],
            [
                'name' => 'vendor_admin',
                'description' => 'Vendor Administrator',
            ],
            [
                'name' => 'vendor_staff',
                'description' => 'Vendor Staff Member',
            ],
            [
                'name' => 'school_admin',
                'description' => 'School Administrator',
            ],
            [
                'name' => 'school_staff',
                'description' => 'School Staff Member',
            ],
            [
                'name' => 'parent',
                'description' => 'Parent/Guardian',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}