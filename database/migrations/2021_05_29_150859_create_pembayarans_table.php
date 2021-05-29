<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('faktur', 12);
            $table->decimal('total', 9, 2)->nullable();
            $table->decimal('diskonBayar', 9, 2)->nullable();
            $table->decimal('pajakBayar', 9, 2)->nullable();
            $table->decimal('dibayars', 9, 2)->nullable();
            $table->decimal('kembaliBayar', 9, 2)->nullable();
            $table->string('statusBayar', 8);
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
        Schema::dropIfExists('pembayarans');
    }
}
