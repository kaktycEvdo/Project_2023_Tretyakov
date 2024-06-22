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
        Schema::create('task_data', function (Blueprint $table) {
            $table->id();
            $table->longText('text');
            $table->timestamp('deadline')->default(now());
            $table->smallInteger('payment_method')->default(0);
            $table->integer('reward');
            $table->boolean('flagged')->default(false);
            $table->timestamps();
        });

        Schema::create("tasks", function (Blueprint $table) {
            $table->id();
            $table->boolean("is_official")->default(false);
            $table->boolean("is_fulfilled")->default(false);
            $table->foreignId("task_data")->unique()->constrained('task_data')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId("purchaser")->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId("freelancer")->nullable()->constrained()->onUpdate('set null')->onDelete('set null');
            $table->boolean('flagged')->default(false);
            $table->longText('tags')->nullable();
            $table->timestamps();
        });

        Schema::create("feedbacks", function (Blueprint $table) {
            $table->id();
            $table->foreignId("task_data")->constrained('task_data')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId("task")->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId("freelancer")->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('flagged')->default(false);
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
