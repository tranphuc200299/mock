<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('category_id');
            $table->integer('store_id');
            $table->text('station')->nullable();;
            $table->string('work_address');
            $table->string('access_address')->nullable();;
            $table->text('photos');
            $table->text('speciality')->nullable();;
            $table->text('note')->nullable();;
            $table->string('bring_items')->nullable();;
            $table->text('skill_required')->nullable();;
            $table->text('other_required')->nullable();;
            $table->boolean('status');;
            $table->softDeletes();
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
        Schema::dropIfExists('occupations');
    }
}
