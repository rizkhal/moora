<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('nik');
            $table->bigInteger('phone')->unique();
            $table->tinyInteger('gender');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('religion');
            $table->bigInteger('province');
            $table->bigInteger('city');
            $table->bigInteger('district');
            $table->bigInteger('sub_district');
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
        Schema::dropIfExists('participans');
    }
}
