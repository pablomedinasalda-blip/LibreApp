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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            // Libro solicitado
            $table->foreignId('book_id')
                ->constrained('books')
                ->restrictOnDelete();

            // Usuario que solicita el préstamo
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Estado del préstamo
            $table->enum('status', [
                'pending',
                'active',
                'returned',
                'overdue'
            ])->default('pending');

            // Fechas
            $table->date('loan_date')->nullable();
            $table->date('due_date');
            $table->date('return_date')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
