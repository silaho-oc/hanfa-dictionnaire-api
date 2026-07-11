<?php

use App\Models\Example;
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
        Schema::create('example_translations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignIdFor(Example::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Language::class)->constrained()->restrictOnDelete();
            $table->text('text');
            $table->timestamps();
            $table->unique(['example_id', 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('example_translations');
    }
};
