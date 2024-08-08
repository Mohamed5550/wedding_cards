<?php

use App\Enums\InviteeNotificationStatus;
use App\Models\Invitee;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invitees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('phone');
            $table->string('status')->default(InviteeNotificationStatus::PENDING);
            $table->timestamp('attended_at')->nullable();
            $table->string('qr_token')->unique();
            $table->timestamps();

            $table->index(['event_id','status']);
            $table->index(['event_id','attended_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitees');
    }
};
