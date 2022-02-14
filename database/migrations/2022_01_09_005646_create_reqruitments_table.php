<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reqruitments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('min_pass')->comment('nilai minimum kelulusan');
            $table->tinyText('description')->nullable();
            $table->smallInteger('req_status')->comment('status penutupan');
            $table->date('start_at')->comment('tanggal mulai penerimaan');
            $table->date('end_at')->comment('tanggal pentutupan');
            $table->foreignId('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reqruitments');
    }
}
