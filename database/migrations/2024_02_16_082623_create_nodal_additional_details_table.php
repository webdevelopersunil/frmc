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
        Schema::create('nodal_additional_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('complain_id')->unsigned();
            $table->bigInteger('nodal_id')->unsigned();
            $table->text('description')->required();

            $table->enum('flag',['document','preliminary_report'])->default('document');

            $table->bigInteger('file_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('complain_id')->references('id')->on('complains')->onDelete('cascade');
            $table->foreign('nodal_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodal_additional_details');
    }
};
