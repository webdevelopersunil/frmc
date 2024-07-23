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
        Schema::create('detailed_statuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fco_id')->unsigned();
            $table->bigInteger('complain_id')->unsigned();
            $table->string('public')->nullable();
            $table->string('private')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('complain_id')->references('id')->on('complains')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailed_statuses');
    }
};
