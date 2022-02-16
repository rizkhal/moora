<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusOnReqruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reqruitments', function (Blueprint $table) {
            $table->tinyInteger('status')->after('end_at')->comment('status for send email and other');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reqruitments', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
