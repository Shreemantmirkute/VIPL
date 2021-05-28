<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidacceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidaccepts', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id');
            $table->string('buyer_user_id');
            $table->string('admin_confirmation')->default('Pending');
            $table->string('admin_comission')->nullable();
            $table->string('admin_payment')->nullable();
            $table->string('price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('bidid')->nullable();
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
        Schema::dropIfExists('bidaccepts');
    }
}
