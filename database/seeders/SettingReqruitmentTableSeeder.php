<?php

namespace Database\Seeders;

use App\Constants\Status;
use App\Models\SettingReqruitment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SettingReqruitmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        SettingReqruitment::create([
            'pas_min' => 65.00,
            'req_status' => Status::ACTIVE, // status penerimaan
            'created_by' => 1
        ]);
    }
}
