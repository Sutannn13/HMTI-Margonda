<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_member_id')->constrained('organization_members')->cascadeOnDelete();
            $table->unsignedTinyInteger('month'); // 1-12
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('amount')->default(25000); // Rp 25.000
            $table->boolean('is_paid')->default(false);
            $table->timestamp('paid_at')->nullable();
            $table->boolean('is_late')->default(false);
            $table->unsignedInteger('fine_amount')->default(0); // Rp 15.000 if late
            $table->unsignedInteger('total_amount')->default(25000); // amount + fine
            $table->text('notes')->nullable();
            $table->foreignId('marked_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['organization_member_id', 'month', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_payments');
    }
};
