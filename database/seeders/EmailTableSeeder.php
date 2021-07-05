<?php

namespace Database\Seeders;

use App\Models\Email;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class EmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Email::create([
            'mail_driver' => 'smtp',
            'mail_host' => 'smtp.mailtrap.io',
            'mail_port' => '2525',
            'mail_username' => '05a3cd2df1e7e7',
            'mail_password' => 'd3c55edc7c38f8',
            'mail_encryption' => 'tls',
            'mail_from_address' => 'noreply@kpu.com',
            'mail_from_name' => 'KPU Email Broadcaster',
            'created_by' => 1
        ]);
    }
}
