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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('simp', 10);
            $table->string('trad', 10);
            $table->string('pinyin');
            $table->string('alpha');
            $table->unsignedTinyInteger('standard_level')->nullable();
            $table->unsignedInteger('standard_order')->nullable();
            $table->unsignedTinyInteger('stroke_count')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed'])->default('pending');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('simp');
            $table->index('trad');
            $table->index('alpha');
            $table->index('standard_level');
            $table->index('standard_order');
            $table->index('status');
            $table->unique(['simp', 'trad']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
