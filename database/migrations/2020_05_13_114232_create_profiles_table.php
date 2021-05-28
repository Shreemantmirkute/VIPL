<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('user_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('office_number')->nullable();
            $table->string('alternate_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('office_email')->nullable();
            $table->string('office_address')->nullable();
            $table->string('office_area')->nullable();
            $table->string('office_city')->nullable();
            $table->string('office_state')->nullable();
            $table->string('office_pincode')->nullable();
            $table->string('factory_address')->nullable();
            $table->string('factory_area')->nullable();
            $table->string('factory_city')->nullable();
            $table->string('factory_state')->nullable();
            $table->string('factory_pincode')->nullable();
            $table->string('are_you')->nullable();
            $table->string('gstin')->nullable();
            $table->string('iec_code')->nullable();
            $table->string('currency')->nullable();
            $table->string('register_as')->nullable();
            $table->string('status')->default('pending');
            $table->string('gstimg')->nullable();
            $table->string('panimg')->nullable();
            $table->string('company_country')->nullable();
            $table->string('office_country')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('factory_country')->nullable();
            $table->string('category')->nullable();
            $table->string('subcategory')->nullable();
            $table->string('product')->nullable();
            $table->string('comission')->nullable();
            $table->string('perunit')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('profiles');
    }
}
