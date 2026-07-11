<?php

use App\Models\Entry;
use App\Models\Label;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entry_label', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Entry::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Label::class)->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('position')->default(1);
            $table->timestamps();
            $table->unique(['entry_id', 'label_id']);
            $table->unique(['entry_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entry_label');
    }
};