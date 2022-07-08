<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGreffJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('greff_jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_id');
            $table->bigInteger('business_id');
            $table->integer('break_time')->nullable();
            $table->integer('required_number_of_person');
            $table->decimal('salary_per_hour');
            $table->decimal('travel_fees')->nullable();
            $table->integer('status');
            $table->integer('setting_matching_job');
            $table->string('qr_code')->nullable();
            $table->timestamps();
            $table->softDeletes(); // add
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('greff_jobs');
    }
}
