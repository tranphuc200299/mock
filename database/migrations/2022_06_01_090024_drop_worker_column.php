<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropWorkerColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('workers', function (Blueprint $table) {
        //     $table->dropColumn('first_name');
        //     $table->dropColumn('last_name');
        //     $table->dropColumn('furigana_first_name');
        //     $table->dropColumn('furigana_last_name');
        //     $table->dropColumn('area');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('last_name');
            $table->string('furigana_first_name');
            $table->string('furigana_last_name');
            $table->string('area')->nullable();
        });
    }
}
