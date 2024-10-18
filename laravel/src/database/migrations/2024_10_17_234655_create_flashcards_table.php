<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Theme;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flashcards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('translation');
            $table->text('description')->nullable();
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Theme::class)->constrained();
            $table->timestamp('created_at')->useCurrent();
            $table->fullText(['title', 'translation']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flashcards');
    }
};
