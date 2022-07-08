<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_name_kana')->nullable();
            $table->string('register_name');
            $table->string('register_name_kana')->nullable();
            $table->string('city');
            $table->string('district');
            $table->string('room')->nullable();
            $table->string('building')->nullable();
            $table->integer('zip_code');
            $table->string('hp_url');
            $table->string('email');
            $table->string('contact_name');
            $table->string('career');
            $table->string('other');
            $table->string('phone');
            $table->integer('status')->default(0);
            $table->string('area_intends_to_recuit')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('company');
    }
}
