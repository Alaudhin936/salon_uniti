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
        Schema::create('vendor_breaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->enum('schedule_type', ['weekly', 'exception'])->comment('weekly=regular, exception=specific date');
            $table->unsignedBigInteger('schedule_id')->comment('Links to vendor_weekly_schedule.id or vendor_schedule_exceptions.id');
            $table->time('break_start');
            $table->time('break_end');
            $table->timestamps();

            $table->foreign('vendor_id')
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
        Schema::dropIfExists('vendor_breaks');
    }
};
