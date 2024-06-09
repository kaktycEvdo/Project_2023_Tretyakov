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
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->longText('about')->nullable();
            $table->string('characteristics', 300)->nullable();
            $table->foreign('email')->references('users')->on('email')->constrained(table: 'users');
            $table->foreignId('official_task')->nullable()->constrained(table: 'tasks');
            $table->foreignId('feedback')->nullable()->constrained(table: 'feedbacks');
            $table->timestamps();
        });

        Schema::create('purchasers', function (Blueprint $table) {
            $table->id();
            $table->longText('about')->nullable();
            $table->string('characteristics', 300)->nullable();
            $table->foreign('email')->references('users')->on('email')->constrained(table: 'users');
            $table->foreignId('task')->nullable()->constrained(table: 'tasks');
            $table->foreignId('official_task')->nullable()->constrained(table: 'tasks');
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->longText('text');
            $table->foreign('author')->references('users')->on('email')->constrained(table: 'users');
            $table->foreign('recepient')->references('users')->on('email')->constrained(table: 'users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancers');
        Schema::dropIfExists('purchasers');
        Schema::dropIfExists('messages');
    }
};
