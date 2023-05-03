<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table -> uuid('id')->unique();
            $table -> string('name');
            $table -> string('user_name');
            $table ->string('categories_id')->nullable();
            $table -> text('content')->nullable();
            $table->integer('user_id');
            $table->string('feature_image_path')->nullable();
            $table->string('feature_image_name')->nullable();
            $table->integer('is_show_home')->default(0);
            $table->integer('status')->default(1);
            $table->integer('stock')->default(1)->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('products');
    }
}
