<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria1 = Criteria::create([
            'name' => 'Riwayat Pendidikan',
            'allow_file_upload' => true,
            'description' => 'Riwayat pendidikan'
        ]);

        collect([
            [
                'text' => 'Sekolah Menengah Pertama',
                'value' => 1,
                'value_type' => 1,
            ],
            [
                'text' => 'Sekolah Menengah Atas',
                'value' => 2,
                'value_type' => 1,
            ],
            [
                'text' => 'Sarjana',
                'value' => 3,
                'value_type' => 1,
            ],
            [
                'text' => 'Magister',
                'value' => 4,
                'value_type' => 1,
            ]
        ])->each(fn ($field) => $criteria1->details()->create($field));

        $criteria2 = Criteria::create([
            'name' => 'Riwayat Penyakit',
            'allow_file_upload' => true,
            'description' => 'Riwayat penyakit'
        ]);

        collect([
            [
                'text' => 'Corona',
                'value' => 1,
                'value_type' => 1,
            ],
            [
                'text' => 'Malaria',
                'value' => 2,
                'value_type' => 1,
            ],
            [
                'text' => 'Lainnya',
                'value' => 3,
                'value_type' => 1,
            ]
        ])->each(fn ($field) => $criteria2->details()->create($field));
    }
}
