<?php

namespace Database\Seeders;

use App\Models\ParentModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the parent user
        $parentUser = User::whereHas('role', function ($query) {
            $query->where('name', 'parent');
        })->first();

        if ($parentUser) {
            ParentModel::create([
                'user_id' => $parentUser->id,
                'phone' => '012-3456789',
                'default_address_line1' => 'No. 45, Jalan Taman Desa',
                'default_address_line2' => 'Taman Desa Harmoni',
                'default_city' => 'Kuala Lumpur',
                'default_state' => 'Wilayah Persekutuan',
                'default_postcode' => '58100',
                'default_country' => 'Malaysia',
            ]);
        }
    }
}