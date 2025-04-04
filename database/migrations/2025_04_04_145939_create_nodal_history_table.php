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
        Schema::create('nodal_history', function (Blueprint $table) {
            $table->id();
            $table->enum('action_type', ['created', 'reassigned'])->nullable(); // Action type (created or reassigned)
            $table->integer('level');
            // Old and New Nodal Officer References
            $table->foreignId('old_nodal_id')->nullable()->constrained('users')->onDelete('set null'); 
            $table->foreignId('new_nodal_id')->nullable()->constrained('users')->onDelete('set null'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodal_history');
    }
};
