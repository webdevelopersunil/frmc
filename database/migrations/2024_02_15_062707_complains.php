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
        Schema::create('complains', function (Blueprint $table) {

            $table->id();
            $table->string('complain_no')->unique()->required();
            $table->bigInteger('complainant_id')->unsigned();
            $table->text('description');
            $table->string('work_centre')->required();
            $table->string('department_section')->required();
            $table->string('against_persons')->nullable();
            $table->string('public_status')->nullable();
            $table->string('complaint_status')->default('With Nodal Officer');
            $table->bigInteger('preliminary_report')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('complainant_id')->references('id')->on('users');
            $table->foreign('preliminary_report')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
