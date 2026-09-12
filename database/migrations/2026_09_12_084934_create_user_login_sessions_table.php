<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_login_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->string('device_hash', 64); // sha256(ip + user_agent)
            $table->timestamp('created_at')->nullable();

            $table->index(['user_id', 'device_hash']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_login_sessions');
    }
};
