<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteria_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id');
            $table->string('text')->nullable()->comment('select option text');
            $table->float('value')->comment('bobot');
            $table->tinyInteger('value_type')->comment('1:benefit 2:cost');
            $table->foreignId('created_by');
            $table->timestamps();
        });

        Schema::create('user_has_criteria_detail', function (Blueprint $table) {
            $table->foreignId('criteria_detail_id');
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criteria_details');
        Schema::dropIfExists('user_has_criteria_detail');
    }
}
