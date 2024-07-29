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
        Schema::create('wedding_cards', function (Blueprint $table) {
            $table->id();
            $table->boolean('has_families')->default(false);
            $table->string('families_font_id')->nullable();
            $table->integer('families_font_size')->nullable();
            $table->string('families_font_weight')->nullable();
            $table->string('families_color')->nullable();
            $table->integer('groom_family_position_x')->nullable();
            $table->integer('groom_family_position_y')->nullable();
            $table->integer('bride_family_position_x')->nullable();
            $table->integer('bride_family_position_y')->nullable();
            $table->string('names_font_id');
            $table->integer('names_font_size');
            $table->string('names_font_weight');
            $table->string('names_color');
            $table->integer('names_position_x');
            $table->integer('names_position_y');
            $table->string('time_location_font_id');
            $table->integer('time_location_font_size');
            $table->string('time_location_font_weight');
            $table->string('time_location_color');
            $table->integer('time_position_x');
            $table->integer('time_position_y');
            $table->integer('location_position_x');
            $table->integer('location_position_y');
            $table->integer('date_position_x');
            $table->integer('date_position_y');
            $table->boolean('has_invitee')->default(false);
            $table->string('invitee_font_id')->nullable();
            $table->integer('invitee_font_size')->nullable();
            $table->string('invitee_font_weight')->nullable();
            $table->string('invitee_color')->nullable();
            $table->string('invitee_prefix')->nullable();
            $table->integer('invitee_x')->nullable();
            $table->integer('invitee_y')->nullable();
            $table->integer('qr_position_x');
            $table->integer('qr_position_y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_cards');
    }
};
