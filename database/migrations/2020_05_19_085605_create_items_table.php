<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->string('category');
            $table->string('product');
            $table->string('subcategory');
            $table->string('register_as');
            $table->string('currency');
            $table->string('otherproduct')->nullable();
            $table->string('perunit');
            $table->string('comission')->nullable();
            $table->string('created_by');
            $table->string('status')->default('Pending');
            $table->string('rejectionreason')->nullable();
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
        Schema::dropIfExists('items');
    }
}
