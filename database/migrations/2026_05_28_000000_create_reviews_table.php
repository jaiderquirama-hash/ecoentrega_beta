<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id_review');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_product');
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();
            $table->dateTime('review_date')->useCurrent();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');
            $table->unique(['id_user', 'id_product']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
