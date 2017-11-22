<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtkinlikTakip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kulturel_etkinlik_takip', function (Blueprint $table) {
        $table->increments('id');
        $table->string('ogr_no');
        $table->string('kart_no');
        $table->string('adsoyad');
        $table->string('ders_mi')->nullable()->default(0);
        $table->string('sinif')->nullable();
        $table->string('sube')->nullable();
        $table->integer('etkinlik_id');
        $table->string('etkinlik_adi');
        $table->Time('giris')->nullable();
        $table->Time('cikis')->nullable();
        $table->integer('sure')->default(0);
        $table->integer('ogr_elemani');
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
        Schema::drop('kulturel_etkinlik_takip');
    }
}
