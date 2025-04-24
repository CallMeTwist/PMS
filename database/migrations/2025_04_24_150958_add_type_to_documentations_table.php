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
        Schema::table('documentations', function (Blueprint $table) {
            $table->enum('type', ['assessment', 'documentation', 'review'])->default('documentation');
        });
    }

    public function down(): void
    {
        Schema::table('documentations', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
