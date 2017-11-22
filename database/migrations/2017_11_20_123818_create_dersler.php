<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDersler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    
        Schema::create('dersler', function (Blueprint $table) {
        $table->increments('id');
        $table->string('ders_adi');
        $table->string('ders_sinif');
        $table->string('ders_sube');
        $table->integer('ogr_elemani');
        $table->integer('durum')->default(1);
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
        //Schema::drop('dersler');
    }
}
