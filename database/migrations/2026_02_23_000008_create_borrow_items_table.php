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
        Schema::create('borrow_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('borrow_transaction_id')->constrained('borrow_transactions')->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
            $table->date('returned_date')->nullable();
            $table->decimal('fine', 8, 2)->default(0);
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_items');
    }
};
