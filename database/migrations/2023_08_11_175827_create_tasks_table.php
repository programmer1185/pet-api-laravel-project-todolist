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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status');
            $table->integer('priority');
            $table->string('title');
            $table->text('description');
            $table->integer('parent_id')->default(0);
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();

            $table->fullText('title');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status')->references('id')->on('task_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
