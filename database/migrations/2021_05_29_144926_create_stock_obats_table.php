<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_obats', function (Blueprint $table) {
            $table->id();
            $table->integer('masuk');
            $table->integer('keluar');
            $table->decimal('beli', 10, 2)->nullable();
            $table->decimal('jual', 10, 2)->nullable();
            $table->date('expired')->nullable();
            $table->integer('stock');
            $table->text('keteranganStock')->nullable();
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
        Schema::dropIfExists('stock_obats');
    }
}
