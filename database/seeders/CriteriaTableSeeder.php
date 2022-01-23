<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Enums\WeightType;
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
        // $c1 = Criteria::create([
        //     'name' => 'Riwayat Pendidikan',
        //     'allow_file_upload' => true,
        //     'description' => 'Riwayat pendidikan'
        // ]);

        // collect([
        //     ['text' => 'Sekolah Menengah Pertama', 'value' => 1, 'value_type' => 1],
        //     ['text' => 'Sekolah Menengah Atas', 'value' => 2, 'value_type' => 1],
        //     ['text' => 'Sarjana', 'value' => 3, 'value_type' => 1],
        //     ['text' => 'Magister', 'value' => 4, 'value_type' => 1]
        // ])->each(fn ($field) => $c1->details()->create($field));

        // $c2 = Criteria::create([
        //     'name' => 'Riwayat Penyakit',
        //     'allow_file_upload' => true,
        //     'description' => 'Riwayat penyakit'
        // ]);

        // collect([
        //     ['text' => 'Corona', 'value' => 1, 'value_type' => 1],
        //     ['text' => 'Malaria', 'value' => 2, 'value_type' => 1],
        //     ['text' => 'Lainnya', 'value' => 3, 'value_type' => 1]
        // ])->each(fn ($field) => $c2->details()->create($field));

        $options = [
            ['text' => 'Option 1', 'weight' => 0.1],
            ['text' => 'Option 2', 'weight' => 0.2],
            ['text' => 'Option 3', 'weight' => 0.3],
            ['text' => 'Option 4', 'weight' => 0.4],
            ['text' => 'Option 5', 'weight' => 0.5],
            ['text' => 'Option 6', 'weight' => 0.6],
            ['text' => 'Option 7', 'weight' => 0.7],
            ['text' => 'Option 8', 'weight' => 0.8],
            ['text' => 'Option 9', 'weight' => 0.9],
            ['text' => 'Option 10', 'weight' => 1],
        ];

        $weight = [
            0.30, // benefit
            0.20, // benefit
            0.20, // benefit
            0.15, // cost
            0.15 // cost
        ];

        for ($i = 0; $i <= 4; $i++) {
            $c = Criteria::create([
                'name' => "Criteria {$i}",
                'allow_file_upload' => false,
                'description' => "Criteria {$i}",
                'weight' => $weight[$i],
                'weight_type' => $i <= 2 ? WeightType::BENEFIT->value : WeightType::COST->value,
            ]);

            collect($options)->each(fn ($field) => $c->details()->create($field));
        }
    }
}
