<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            // MySQL needs the FK dropped before dropping the unique index it uses
            $table->dropForeign(['id_order']);
            $table->dropForeign(['id_product']);
            $table->dropUnique(['id_order', 'id_product']);

            // Re-add foreign keys without the unique constraint
            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('products')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign(['id_order']);
            $table->dropForeign(['id_product']);
            $table->unique(['id_order', 'id_product']);
            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('products')->restrictOnDelete();
        });
    }
};
