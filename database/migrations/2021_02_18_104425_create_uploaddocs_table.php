<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploaddocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploaddocs', function (Blueprint $table) {
            $table->id();
            $table->string('bid_id');
            $table->string('purchase_date')->nullable();
            $table->string('purchase_order_no')->nullable();
            $table->string('purchase_order_date')->nullable();
            $table->string('purchase_order_slip')->nullable();
            $table->string('quantity')->nullable();
            $table->string('amount')->nullable();
            $table->string('sale_date')->nullable();
            $table->string('acknowledgement')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('lr_no')->nullable();
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
        Schema::dropIfExists('uploaddocs');
    }
}
