<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                $table->foreign('id_user')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });

            return;
        }

        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');

            $table->string('product_name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('size');
            $table->string('garment_condition');
            $table->string('color');
            $table->string('image')->nullable();
            $table->dateTime('publication_date')->useCurrent();

            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_category')
                  ->references('id_category')
                  ->on('categories')
                  ->onDelete('cascade');

            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
