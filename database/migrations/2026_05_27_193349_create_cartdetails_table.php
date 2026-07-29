<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id('id_cart');

            $table->dateTime('creation_date');

            $table->unsignedBigInteger('id_user');

            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->unique('id_user');
        });

        Schema::create('cart_details', function (Blueprint $table) {
            $table->id('id_cart_detail');
            $table->unsignedBigInteger('id_cart');
            $table->unsignedBigInteger('id_product');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('subtotal', 10, 2);

            $table->foreign('id_cart')->references('id_cart')->on('shopping_carts')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');
            $table->unique(['id_cart', 'id_product']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_details');
        Schema::dropIfExists('shopping_carts');
    }
};
