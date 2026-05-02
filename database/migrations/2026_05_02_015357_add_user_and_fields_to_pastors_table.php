<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pastors', function (Blueprint $table) {

            // ONLY add missing column
            if (!Schema::hasColumn('pastors', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pastors', function (Blueprint $table) {
            if (Schema::hasColumn('pastors', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
