<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtkinlik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etkinlik', function (Blueprint $table) {
        $table->increments('id');
        $table->string('ad');
        $table->string('yer');
        $table->date('tarih');
        $table->time('baslama')->nullable();
        $table->time('bitis')->nullable();
        $table->string('etkinlikte_ne_kadar_kalinmali')->default(30);
        $table->string('etkinlik_oncesi_okutma_suresi')->default(15);
        $table->string('etkinlik_sonrasi_okutma_suresi')->default(15);
        $table->integer('ders_mi')->nullable()->default(0);
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
        Schema::drop('etkinlik');
    }
}
