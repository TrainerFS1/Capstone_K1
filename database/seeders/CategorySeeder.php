<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => 'IT & Software'],
            ['category_name' => 'Finance'],
            ['category_name' => 'Healthcare'],
            ['category_name' => 'Education'],
            ['category_name' => 'Engineering'],
            ['category_name' => 'Marketing'],
            ['category_name' => 'Sales'],
            ['category_name' => 'Customer Service'],
            ['category_name' => 'Human Resources'],
            ['category_name' => 'Legal'],
            ['category_name' => 'Operations'],
            ['category_name' => 'Art & Design'],
            ['category_name' => 'Media & Communication'],
            ['category_name' => 'Logistics'],
            ['category_name' => 'Construction'],
            ['category_name' => 'Hospitality'],
        ]);
    }
}
