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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            // Relationships
            $table->foreignId('church_id')->constrained()->cascadeOnDelete();

            // Personal Info
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');

            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();

            // Contact
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->text('address')->nullable();

            // Church Status
            $table->string('member_status')->default('active');
            // active, inactive, transferred

            $table->date('membership_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
