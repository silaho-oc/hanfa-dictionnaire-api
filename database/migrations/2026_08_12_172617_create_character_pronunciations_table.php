<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('character_pronunciations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('character_id')->constrained('characters')->cascadeOnDelete();
            $table->string('pinyin', 100);
            $table->string('alpha', 100);
            $table->unsignedTinyInteger('position')->default(1);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            $table->unique(['character_id', 'pinyin'], 'character_pronunciations_character_pinyin_unique');
            $table->index(['character_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('character_pronunciations');
    }
};