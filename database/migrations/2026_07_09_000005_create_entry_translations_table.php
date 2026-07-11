<?php

use App\Models\Entry;
use App\Models\Language;
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
        Schema::create('entry_translations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignIdFor(Entry::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Language::class)->constrained()->restrictOnDelete();
            $table->text('text');
            $table->unsignedTinyInteger('position');
            $table->timestamps();
            $table->unique(['entry_id', 'language_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_translations');
    }
};
