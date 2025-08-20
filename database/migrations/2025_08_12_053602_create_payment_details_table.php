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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->unique();
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->enum('status', ['completed', 'pending', 'failed']);
            $table->timestamps();

            $table->foreign('appointment_id')->on('appointments')->references('id')->onDelete('cascade');
            $table->foreign('payment_method_id')->on('payment_methods')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
