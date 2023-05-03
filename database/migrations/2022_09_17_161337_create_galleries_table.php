<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table -> uuid('id')->unique();
            $table->integer('user_id');
            $table -> string('user_name');
            $table->integer('status')->default(1);
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('feature_image_path');
            $table->string('feature_image_name');
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
        Schema::dropIfExists('galleries');
    }
}
