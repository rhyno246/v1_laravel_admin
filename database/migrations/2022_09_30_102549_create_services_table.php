<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table -> uuid('id')->unique();
            $table -> string('name');
            $table -> text('content');
            $table->integer('user_id');
            $table->string('user_name');
            $table->integer('is_show_home')->default(0);
            $table->integer('status')->default(1);
            $table->string('slug');
            $table->string('feature_image_path')->nullable();
            $table->string('feature_image_name')->nullable();
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
        Schema::dropIfExists('services');
    }
}
