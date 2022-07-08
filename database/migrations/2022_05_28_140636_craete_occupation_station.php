<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteOccupationStation extends Migration
{
    /**
     * Run the migrations.store_station
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupation_station', function (Blueprint $table) {
            $table->string('occupation_id', 10);
            $table->string('station_id', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('occupation_station');
    }
}
