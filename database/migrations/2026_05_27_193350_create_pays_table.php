<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('payments', function (Blueprint $table) {
    $table->id('id_payment');

    $table->string('payment_method');
    $table->string('payment_status');
    $table->dateTime('payment_date');
    $table->decimal('amount', 10, 2);
});
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};