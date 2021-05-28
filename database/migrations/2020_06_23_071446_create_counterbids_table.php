<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterbidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterbids', function (Blueprint $table) {
            $table->id();
            $table->string('bid_id');
            $table->string('new_price');
            $table->string('new_quantity');
            $table->string('instruction')->nullable();
            $table->string('perunit')->nullable();
            $table->string('unit')->nullable();
            $table->string('currency')->nullable();
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
        Schema::dropIfExists('counterbids');
    }
}
