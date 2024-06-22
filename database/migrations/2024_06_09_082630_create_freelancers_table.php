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
            $table->string('email', 70)->unique();
            $table->foreign('email')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('flagged')->default(false);
            $table->timestamps();
        });

        Schema::create('purchasers', function (Blueprint $table) {
            $table->id();
            $table->longText('about')->nullable();
            $table->string('characteristics', 300)->nullable();
            $table->string('email', 70)->unique();
            $table->foreign('email')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('flagged')->default(false);
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->longText('text');
            $table->unsignedBigInteger('author');
            $table->unsignedBigInteger('recepient');
            $table->foreign('author')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('recepient')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('flagged')->default(false);
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
