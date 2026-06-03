<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');

            $table->string('product_name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('size');
            $table->string('garment_condition');
            $table->string('color');
            $table->string('image');
            $table->dateTime('publication_date');

            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_category')
                  ->references('id_category')
                  ->on('categories')
                  ->onDelete('cascade');

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};