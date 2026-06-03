<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sends', function (Blueprint $table) {
            $table->id('id_send');

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_request');

            $table->string('send_status')->default('pending');

            $table->text('notes')->nullable();

            $table->dateTime('send_date');

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_request')
                  ->references('id_request')
                  ->on('requests')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sends');
    }
};