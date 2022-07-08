<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToGreffJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('greff_jobs', function (Blueprint $table) {
            $table->date('work_date');
            $table->time('work_time');
            $table->time('work_time_from');
            $table->time('work_time_to');
            $table->dateTime('deadline_for_apply')->nullable();
            $table->time('deadline_time_apply')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('greff_jobs', function (Blueprint $table) {
            $table->dropColumn('work_date');
            $table->dropColumn('work_time');
            $table->dropColumn('work_time_from');
            $table->dropColumn('work_time_to');
            $table->dropColumn('deadline_for_apply');
            $table->dropColumn('deadline_time_apply');
        });
    }
}
