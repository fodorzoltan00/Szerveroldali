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
        Schema::create('position_room', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('room_id');
            $table->primary(['position_id', 'room_id']);
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_room');
    }
};
