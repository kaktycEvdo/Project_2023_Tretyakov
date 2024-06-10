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
        Schema::create("tasks", function (Blueprint $table) {
            $table->id();
            $table->boolean("is_official");
            $table->foreignId("task_data");
            $table->foreignId('purchaser');
            $table->foreignId('freelancer')->nullable();
            $table->timestamps();
        });

        Schema::create("feedbacks", function (Blueprint $table) {
            $table->id();
            $table->foreignId("task_data");
            $table->foreignId('freelancer');
            $table->timestamps();
        });

        Schema::create('task_data', function (Blueprint $table) {
            $table->id();
            $table->longText('text');
            $table->timestamp('deadline')->default(now());
            $table->smallInteger('payment_method')->default(0);
            $table->integer('reward');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('feedbacks');
        Schema::dropIfExists('task_data');
    }
};
