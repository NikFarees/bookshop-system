<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = [
            [
                'type' => 'school',
                'name' => 'Sekolah Kebangsaan Bukit Sekilau',
                'code' => 'SKBS123',
                'status' => 'approved',
                'phone' => '03-1234567',
                'email' => 'admin@skbuikitsekilau.edu.my',
                'address_line1' => 'Jalan Bukit Sekilau',
                'address_line2' => 'Taman Bukit Sekilau',
                'city' => 'Kuala Lumpur',
                'state' => 'Selangor',
                'postcode' => '50200',
                'country' => 'Malaysia',
            ],
            [
                'type' => 'vendor',
                'name' => 'Edustream',
                'code' => 'EDU123',
                'status' => 'approved',
                'phone' => '03-7654321',
                'email' => 'info@edustream.com.my',
                'address_line1' => 'No. 123, Jalan Pendidikan',
                'address_line2' => 'Taman Ilmu',
                'city' => 'Petaling Jaya',
                'state' => 'Selangor',
                'postcode' => '47800',
                'country' => 'Malaysia',
            ],
        ];

        foreach ($organizations as $organization) {
            Organization::create($organization);
        }
    }
}