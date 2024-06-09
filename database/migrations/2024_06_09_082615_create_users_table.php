<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->string('email')->primary()->unique();
            $table->string('name', 52);
            $table->string('surname', 52);
            $table->string('patronymic', 52);
            $table->boolean('is_admin')->default(false);
            $table->timestamp('last_online')->default(now());
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('login')->references('login')->on('personal_data')->constrained(table: 'personal_data');
        });

        Schema::dropIfExists('password_reset_tokens');
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('user')->constrained(table: 'users');
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::dropIfExists('sessions');
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreign('user_id')->references('email')->on('users')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::dropIfExists('cards');
        Schema::create('cards', function (Blueprint $table) {
            $table->foreign('user')->references('email')->on('user')->constrained(table: 'users');
            $table->integer('number');
            $table->string('expiry', 5);
            $table->integer('sc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('cards');
    }
};
