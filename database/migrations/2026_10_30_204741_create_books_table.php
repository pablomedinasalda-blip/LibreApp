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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // Relaciones con categorías y autores
            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->foreignId('author_id')
                ->constrained('authors')
                ->restrictOnDelete();

            // Información del libro
            $table->string('title');
            $table->string('isbn')->unique();
            $table->text('description')->nullable();
            $table->year('year')->nullable();

            // Control de ejemplares
            $table->unsignedInteger('copies_total')->default(1);
            $table->unsignedInteger('copies_available')->default(1);

            $table->string('cover_image')->nullable();
            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
