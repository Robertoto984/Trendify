<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->string('type'); // 1 => payment_status, 2 => status 
            $table->string('payment_status')->nullable(); // 1 => paid, 2 => unpaid 
            $table->string('status')->nullable(); // 1 => cancelled, 2 => delivered, 3 => new, 4 => process
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_logs');
    }
};
