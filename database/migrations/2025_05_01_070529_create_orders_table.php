<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->float('discount');
            $table->float('total');
            $table->string('payment_method'); // 1 => cod
            $table->string('payment_status'); // 1 => paid, 2 => unpaid
            $table->string('status'); // 1 => cancelled, 2 => delivered, 3 => new, 4 => process
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
