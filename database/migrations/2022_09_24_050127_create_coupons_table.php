<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table -> bigIncrements('id');
            $table -> string('user_name');
            $table->integer('user_id');
            $table->string('coupons_key');
            $table->string('date_start');
            $table->string('date_end');
            $table->integer('coupons_value')->default(0);
            $table->integer('coupons_cart_value');
            $table->string('customer_group');
            $table->integer('coupons_price');
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
        Schema::dropIfExists('coupons');
    }
}
