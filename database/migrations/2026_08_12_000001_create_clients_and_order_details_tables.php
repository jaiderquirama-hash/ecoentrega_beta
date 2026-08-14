<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('id_client');
            $table->unsignedBigInteger('id_user')->unique();
            $table->string('document_number')->nullable()->unique();
            $table->string('phone', 30)->nullable();
            $table->string('address')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('id_client')->nullable()->after('id_user');
            $table->foreign('id_client')->references('id_client')->on('clients')->nullOnDelete();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id('id_order_detail');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_product');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('products')->restrictOnDelete();
            $table->unique(['id_order', 'id_product']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['id_client']);
            $table->dropColumn('id_client');
        });

        Schema::dropIfExists('clients');
    }
};
