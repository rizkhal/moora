<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type')->comment('file or options');
            $table->tinyText('description')->nullable();
            $table->foreignId('created_by');
            $table->timestamps();
        });

        // $table->id();
        //     $table->foreignId('criteria_id')->constrained('criterias')->onUpdate('cascade')->onDelete('cascade');
        //     $table->float('weight')->comment('bobot');
        //     $table->tinyInteger('type')->comment('benefit or cost');
        //     $table->timestamps();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criterias');
    }
}
