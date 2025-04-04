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
        Schema::create('nodal_history_complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nodal_history_id')->constrained('nodal_history')->onDelete('cascade'); // Reference to history
            $table->foreignId('complaint_id')->constrained('complains')->onDelete('cascade'); // Complaint ID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodal_history_complaints');
    }
};
