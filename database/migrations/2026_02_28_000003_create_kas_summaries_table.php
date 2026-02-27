<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('total_expected')->default(0);
            $table->unsignedInteger('total_collected')->default(0);
            $table->unsignedInteger('total_fines')->default(0);
            $table->unsignedInteger('total_balance')->default(0);
            $table->text('notes')->nullable(); // e.g., "dikembalikan" or "untuk planning bersama"
            $table->enum('disposition', ['pending', 'returned', 'planning'])->default('pending');
            $table->timestamps();

            $table->unique(['month', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_summaries');
    }
};
