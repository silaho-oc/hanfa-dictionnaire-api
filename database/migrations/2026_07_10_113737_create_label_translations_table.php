<?php

use App\Models\Label;
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
        Schema::create('label_translations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignIdFor(Label::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Language::class)->constrained()->restrictOnDelete();
            $table->string('code')->unique();
            $table->string('name');
            $table->timestamps();
            $table->unique(['label_id', 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_translations');
    }
};
