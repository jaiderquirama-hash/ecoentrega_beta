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
    Schema::create('requests', function (Blueprint $table) {
        $table->id('id_request'); // 🔥 CLAVE

        $table->string('title');
        $table->text('description');

        $table->string('size');
        $table->string('color');

        $table->decimal('max_price', 10, 2)->nullable();

        $table->string('status')->default('pending');

        $table->dateTime('request_date');

        $table->unsignedBigInteger('id_user');

        $table->foreign('id_user')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
