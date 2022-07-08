<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameGreffJobsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('greff_jobs', function (Blueprint $table) {
            $table->renameColumn('business_id', 'occupation_id');
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
            $table->renameColumn('occupation_id', 'business_id');
        });
    }
}
