<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_data', function (Blueprint $table) {
            $table->string('email', 70)->primary()->unique();
            $table->string('name', 52);
            $table->string('surname', 52);
            $table->string('patronymic', 52);
            $table->string('phone', 17);
            $table->timestamp('last_online')->default(now());
            $table->boolean('flagged')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->string('login', 70)->primary()->unique();
            $table->string('password', 70);
            $table->longText('remember_token')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('flagged')->default(false);
            $table->string('email', 70);
            $table->foreign('email')->references('email')->on('personal_data')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 70);
            $table->foreign('email')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            $table->boolean('flagged')->default(false);
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id', 70)->nullable();
            $table->foreign('user_id')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
            $table->boolean('flagged')->default(false);
        });

        Schema::create('cards', function (Blueprint $table) {
            $table->string('user', 70);
            $table->foreign('user')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('number', 16);
            $table->string('expiry', 5);
            $table->integer('sc');
            $table->boolean('flagged')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('personal_data');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('cards');
    }
};
