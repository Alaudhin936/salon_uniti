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
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->string('business_name');
            $table->string('slogan')->nullable();
            $table->string('type')->nullable();
            $table->string('location');
            $table->string('shop_open');
            $table->string('shop_close');
            $table->string('buffer_timing');
            $table->string('cover_photo')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('gst_number')->nullable();
            $table->string('lattitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_details');
    }
};
