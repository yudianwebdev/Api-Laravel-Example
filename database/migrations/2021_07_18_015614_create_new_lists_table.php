<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_lists', function (Blueprint $table) {
            $table->id();
            $table->string('IdNewList')->default('NewList');
            $table->string('Barcode');
            $table->string("NamaBarang");
            $table->integer("qty")->default(1);
            $table->double("Harga");
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
        Schema::dropIfExists('new_lists');
    }
}
