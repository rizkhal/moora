<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->tinyInteger('status')->comment('mark, draft, etc');
            $table->foreignId('created_by')->nullable()->comment('if null, the announcement generated by system');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('announcement_has_reqruitments', function (Blueprint $table) {
            $table->foreignId('reqruitment_id')->constrained('reqruitments')->onDelete('cascade');
            $table->foreignId('announcement_id')->constrained('announcements')->onDelete('cascade');
        });

        Schema::create('announcement_has_users', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('announcement_id')->constrained('announcements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('announcement_has_users');
        Schema::dropIfExists('announcement_has_reqruitments');
    }
}
