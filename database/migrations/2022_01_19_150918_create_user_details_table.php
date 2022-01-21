<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->bigInteger('nik');
            $table->bigInteger('phone')->unique();
            $table->tinyInteger('gender');
            $table->string('picture');
            $table->timestamps();
        });

        Schema::create('user_has_criterias', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('model_type');
            $table->foreignId('criteria_id')->constrained('criterias')->onDelete('cascade');
        });

        Schema::create('user_has_criteria_details', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('model_type');
            $table->foreignId('criteria_detail_id')->constrained('criteria_details')->onDelete('cascade');
            $table->string('file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
        Schema::dropIfExists('user_has_criterias');
        Schema::dropIfExists('user_has_criteria_details');
    }
}
