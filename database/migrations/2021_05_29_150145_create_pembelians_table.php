<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('faktur', 12);
            $table->decimal('jual', 9, 2)->nullable();
            $table->string('item', 30);
            $table->integer('qtyBeli');
            $table->decimal('totalKotor', 9, 2)->nullable();
            $table->decimal('diskonBeli', 9, 2)->nullable();
            $table->decimal('totalBersih', 9, 2)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('ketranganBeli', 150);
            $table->decimal('pajakBeli', 9, 2)->nullable();
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
        Schema::dropIfExists('pembelians');
    }
}
