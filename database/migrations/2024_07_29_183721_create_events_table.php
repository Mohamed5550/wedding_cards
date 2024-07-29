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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('time');
            $table->string('location');
            $table->string('groom_family');
            $table->string('groom_name');
            $table->string('bride_family');
            $table->string('bride_name');
            $table->foreignId('wedding_card_id')->constrained()->restrictOnDelete()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
