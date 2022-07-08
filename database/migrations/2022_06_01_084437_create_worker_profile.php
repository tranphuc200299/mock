<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_profile', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('worker_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('furigana_first_name');
            $table->string('furigana_last_name');
            $table->string('area')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('passport_image_front')->nullable();
            $table->string('passport_image_back')->nullable();
            $table->string('degree')->nullable();
            $table->string('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->tinyInteger('status')->default(3);
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
        Schema::dropIfExists('worker_profile');
    }
}
