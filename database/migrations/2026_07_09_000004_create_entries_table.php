<?php

use App\Models\Character;
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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignIdFor(Character::class)->constrained()->cascadeOnDelete();
            $table->string('trad');
            $table->string('simp');
            $table->string('pinyin');
            $table->string('alpha');
            $table->timestamps();

            $table->index('simp');
            $table->index('trad');
            $table->index('alpha');
            $table->index('character_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
