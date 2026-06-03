<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_details', function (Blueprint $table) {
            $table->id('id_request_detail');

            $table->unsignedBigInteger('id_request');
            $table->unsignedBigInteger('id_product');

            $table->integer('quantity')->default(1);

            $table->text('message')->nullable();

            $table->dateTime('created_at')->useCurrent();

            $table->foreign('id_request')
                  ->references('id_request')
                  ->on('requests')
                  ->onDelete('cascade');

            $table->foreign('id_product')
                  ->references('id_product')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_details');
    }
};