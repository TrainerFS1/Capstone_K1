<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Industry;

class IndustriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data industri yang akan dimasukkan
        $industries = [
            'Teknologi Informasi',
            'Kesehatan',
            'Pendidikan',
            'Keuangan',
            'Pariwisata',
            'Jasa Konsultasi',
            'Otomotif',
            'Manufaktur',
            'Retail',
            'Logistik',
            'Energi dan Sumber Daya',
            'Pertanian',
            'Konstruksi',
            'Media dan Hiburan',
            'Telekomunikasi',
            'Makanan dan Minuman',
            'Mode dan Busana',
            'Properti',
            'Hukum',
            'Pemerintahan',
            'Layanan Sosial',
            // Tambahkan industri lainnya sesuai kebutuhan
        ];

        // Loop untuk memasukkan data ke dalam database
        foreach ($industries as $industry) {
            Industry::create([
                'industry_name' => $industry,
            ]);
        }
    }
}
