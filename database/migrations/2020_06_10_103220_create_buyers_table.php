<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->string('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_image')->nullable();
            $table->string('origin')->nullable();
            $table->string('price');
            $table->string('quantity');
            $table->string('chemical_specification')->nullable();
            $table->string('physical_specification')->nullable();
            $table->string('payment')->nullable();
            $table->string('tandc')->nullable();
            $table->string('otandc')->nullable();
            $table->string('status')->default('pending');
            $table->string('soldprice')->default('0');
            $table->string('purchasedby')->nullable();
            $table->string('taxclass')->nullable();
            $table->string('purchasedon')->nullable();
            $table->string('created_by')->nullable();
            $table->string('currency')->nullable();
            $table->string('minimum_order_quantity')->nullable();
            $table->string('minimum_order_unit')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('unit')->nullable();
            $table->string('perunit')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
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
        Schema::dropIfExists('buyers');
    }
}
