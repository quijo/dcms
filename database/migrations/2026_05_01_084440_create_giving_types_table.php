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
        Schema::create('giving_types', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // WEF, NMI, NYI, etc
            $table->string('code')->nullable(); // optional shorthand
            $table->boolean('is_custom')->default(false);
            $table->string('category')->nullable(); // budget, mission, youth, etc
            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giving_types');
    }
};
