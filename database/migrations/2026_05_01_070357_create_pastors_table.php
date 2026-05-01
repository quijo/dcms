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
        Schema::create('pastors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('church_id')->constrained()->cascadeOnDelete();

            $table->string('first_name');
            $table->string('Middle_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();

            $table->string('role')->default('pastor');
            // senior pastor, associate pastor, etc

            $table->string('type')->default('local');

            $table->date('ordination_date')->nullable();

            $table->string('status')->default('active');
            // active / inactive

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastors');
    }
};
