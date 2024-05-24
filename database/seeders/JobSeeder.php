<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Company; // Jika Anda perlu menghubungkan job dengan company
use App\Models\Category; // Jika Anda perlu menghubungkan job dengan category
use App\Models\JobType; // Jika Anda perlu menghubungkan job dengan job type
use Faker\Factory as Faker;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Misalnya, Anda memiliki 10 perusahaan, 5 kategori, dan 3 jenis pekerjaan yang sudah ada
        $companies = Company::pluck('id')->all();
        $categories = Category::pluck('id')->all();
        $jobTypes = JobType::pluck('id')->all();

        // Buat 50 job untuk uji coba pagination
        for ($i = 0; $i < 50; $i++) {
            Job::create([
                'job_title' => $faker->jobTitle,
                'company_id' => $faker->randomElement($companies),
                'category_id' => $faker->randomElement($categories),
                'job_type_id' => $faker->randomElement($jobTypes),
                'job_salary' => $faker->numberBetween(3000000, 15000000),
                'job_status' => $faker->randomElement(['active', 'inactive']),
            ]);
        }
    }
}
