<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StockObats extends Migration
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
            $table->unsignedBigInteger('idObat');
            $table->foreign('id')->references('id')->on('obats')->onDelete('cascade');
            $table->integer('masuk');
            $table->integer('keluar');
            $table->decimal('beli', 10, 2)->nullable();
            $table->decimal('jual', 10, 2)->nullable();
            $table->date('expired')->nullable();
            $table->integer('stock');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('admin');
            $table->foreign('name')->references('id')->on('users')->onDelete('cascade');
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
        //
    }
}
