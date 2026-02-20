<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\ParentModel;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the parent and school
        $parent = ParentModel::first();
        $school = Organization::where('type', 'school')->first();

        if ($parent && $school) {
            $children = [
                [
                    'parent_id' => $parent->id,
                    'full_name' => 'Ahmad Danial bin Parent',
                    'school_id' => $school->id,
                    'grade_label' => 'Darjah 4',
                    'status' => 'active',
                ],
                [
                    'parent_id' => $parent->id,
                    'full_name' => 'Nurul Aisyah binti Parent',
                    'school_id' => $school->id,
                    'grade_label' => 'Darjah 2',
                    'status' => 'active',
                ],
            ];

            foreach ($children as $child) {
                Child::create($child);
            }
        }
    }
}