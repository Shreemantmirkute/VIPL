<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id');
            $table->string('buyer_user_id');
            $table->string('new_price');
            $table->string('new_quantity');
            $table->string('admin_confirmation')->default('Pending');
            $table->string('admin_comission')->nullable();
            $table->string('admin_payment')->nullable();
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
        Schema::dropIfExists('bids');
    }
}
