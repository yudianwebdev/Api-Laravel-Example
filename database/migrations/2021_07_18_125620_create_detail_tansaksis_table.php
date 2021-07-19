<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTansaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_tansaksis', function (Blueprint $table) {
            $table->id();
            $table->string('IdTransaksi');
            $table->string('Barcode');
            $table->string('NamaBarang');
            $table->double('QTY');
            $table->double('Harga');
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
        Schema::dropIfExists('detail_tansaksis');
    }
}
