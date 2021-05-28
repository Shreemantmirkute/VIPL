<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalbidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalbids', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id')->nullable();
            $table->string('buyer_id')->nullable();
            $table->string('offer_id')->nullable();
            $table->string('enquiry_id')->nullable();
            $table->string('new_price')->nullable();
            $table->string('new_quantity')->nullable();
            $table->string('new_unit')->nullable();
            $table->string('bidtype')->nullable();
            $table->string('bid_tracker')->nullable();
            $table->string('new_currency')->nullable();
            $table->string('new_perunit')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->string('admin_confirmation')->default('Pending');
            $table->string('instruction')->nullable();
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
        Schema::dropIfExists('finalbids');
    }
}
