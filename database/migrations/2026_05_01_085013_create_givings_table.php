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
        Schema::create('givings', function (Blueprint $table) {
            $table->id();

            // relations
            $table->foreignId('church_id')->constrained();
            $table->foreignId('giving_type_id')->constrained('giving_types');
            $table->foreignId('member_id')->nullable()->constrained();

            // financial data
            $table->decimal('amount', 12, 2);
            $table->date('date');

            // reference
            $table->string('receipt_number')->nullable();
            $table->string('reference_number')->nullable();

            // proof
            $table->string('proof_path')->nullable();

            // workflow
            $table->string('status')->default('pending');
            // pending | approved | rejected
            $table->foreignId('fiscal_year_id')->constrained();
            $table->foreignId('approved_by')->nullable(); // district treasurer
            $table->timestamp('approved_at')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('givings');
    }
};
