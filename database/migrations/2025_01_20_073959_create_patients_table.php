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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->unsignedTinyInteger('age');
            $table->enum('sex', ['Male', 'Female'])->default('Male');
            $table->string('next_of_kin');
            $table->string('tribe');
            $table->string('place_of_origin');
            $table->string('occupation');
            $table->string('Religion');
            $table->date('date_of_birth');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('ward_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_in_patient')->default(true);
            $table->date('discharge_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
