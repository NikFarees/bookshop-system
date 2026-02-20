<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'role_name' => 'super_admin',
                'name' => 'Nik',
                'email' => 'nik@gmail.com',
                'password' => 'Bookshop@SuperAdmin',
                'status' => 'active',
            ],
            [
                'role_name' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'Bookshop@Admin',
                'status' => 'active',
            ],
            [
                'role_name' => 'vendor_admin',
                'name' => 'Vendor Admin',
                'email' => 'vendoradmin@gmail.com',
                'password' => 'Bookshop@VendorAdmin',
                'status' => 'active',
            ],
            [
                'role_name' => 'vendor_staff',
                'name' => 'Vendor Staff',
                'email' => 'vendorstaff@gmail.com',
                'password' => 'Bookshop@VendorStaff',
                'status' => 'active',
            ],
            [
                'role_name' => 'school_admin',
                'name' => 'School Admin',
                'email' => 'schooladmin@gmail.com',
                'password' => 'Bookshop@SchoolAdmin',
                'status' => 'active',
            ],
            [
                'role_name' => 'school_staff',
                'name' => 'School Staff',
                'email' => 'schoolstaff@gmail.com',
                'password' => 'Bookshop@SchoolStaff',
                'status' => 'active',
            ],
            [
                'role_name' => 'parent',
                'name' => 'Parent',
                'email' => 'parent@gmail.com',
                'password' => 'Bookshop@Parent',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $role = Role::where('name', $userData['role_name'])->first();

            User::create([
                'role_id' => $role->id,
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'status' => $userData['status'],
                'email_verified_at' => now(),
            ]);
        }
    }
}