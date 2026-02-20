<?php

namespace Database\Seeders;

use App\Models\OrganizationUser;
use App\Models\Organization;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class OrganizationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get organizations
        $school = Organization::where('code', 'SKBS123')->first();
        $vendor = Organization::where('code', 'EDU123')->first();

        // Get users by their roles
        $schoolAdmin = User::whereHas('role', function ($query) {
            $query->where('name', 'school_admin');
        })->first();

        $schoolStaff = User::whereHas('role', function ($query) {
            $query->where('name', 'school_staff');
        })->first();

        $vendorAdmin = User::whereHas('role', function ($query) {
            $query->where('name', 'vendor_admin');
        })->first();

        $vendorStaff = User::whereHas('role', function ($query) {
            $query->where('name', 'vendor_staff');
        })->first();

        $organizationUsers = [
            [
                'organization_id' => $school->id,
                'user_id' => $schoolAdmin->id,
                'org_role' => 'admin',
                'status' => 'active',
            ],
            [
                'organization_id' => $school->id,
                'user_id' => $schoolStaff->id,
                'org_role' => 'staff',
                'status' => 'active',
            ],
            [
                'organization_id' => $vendor->id,
                'user_id' => $vendorAdmin->id,
                'org_role' => 'admin',
                'status' => 'active',
            ],
            [
                'organization_id' => $vendor->id,
                'user_id' => $vendorStaff->id,
                'org_role' => 'staff',
                'status' => 'active',
            ],
        ];

        foreach ($organizationUsers as $organizationUser) {
            OrganizationUser::create($organizationUser);
        }
    }
}