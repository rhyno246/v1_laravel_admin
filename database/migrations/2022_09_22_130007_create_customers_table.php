<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table -> uuid('id')->unique();
            $table-> string('name');
            $table->string('src')->nullable();
            $table->string('image_name')->nullable();
            $table->string('email')->unique();
            $table->integer('phone');
            $table->string('password');
            $table->integer('status')->default(1);
            $table->string('role')->default('normal');
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
        Schema::dropIfExists('customers');
    }
}
