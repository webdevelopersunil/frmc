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
        Schema::create('user_additional_details', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('complain_id')->unsigned();
            $table->bigInteger('complainant_id')->unsigned();
            $table->text('description')->required();
            $table->bigInteger('file_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('complain_id')->references('id')->on('complains')->onDelete('cascade');
            $table->foreign('complainant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_additional_details');
    }
};
