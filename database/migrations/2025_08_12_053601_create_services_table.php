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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->string('name');
            $table->string('price');
            $table->string('duration');
            $table->boolean('is_active')->default(1);
            $table->string('discount_percentage')->nullable();
            $table->string('service_img');
            $table->unsignedBigInteger('service_category_id');
            $table->boolean('services')->default(1);
            $table->timestamps();

            $table->foreign('service_category_id')->on('service_categories')->references('id')->onDelete('cascade');
            $table->foreign('vendor_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
