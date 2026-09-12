<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table name deliberately isn't "notifications" — User already uses
     * Laravel's own Notifiable trait, which expects a "notifications"
     * table with its own (incompatible) schema. Using a distinct name
     * avoids any collision with that.
     */
    public function up(): void
    {
        Schema::create('app_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('category', 40);   // Bank Account, Calendar, Mailbox, City Hall, Education Finance Department, City Mood, Settings
            $table->string('type', 60);       // transaction, transfer, statement, account_opened, password_changed, new_device, activity_assigned, badge_earned, mood_logged, mailbox_message, donation, vote_cast, petition_signed, petition_submitted
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('icon', 60)->nullable();
            $table->string('color', 20)->nullable(); // blue, green, purple, orange, red, amber
            $table->nullableMorphs('source');       // source_type / source_id -> the model that triggered it
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'read_at']);
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_notifications');
    }
};
