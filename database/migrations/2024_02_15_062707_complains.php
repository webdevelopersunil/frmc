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

            // Test Purpose Fields
            // $table->string('work_centre')->nullable();
            // $table->string('department_section')->nullable();
            // Test Purpose Fields

            $table->bigInteger('work_centre_id')->unsigned();
            $table->bigInteger('department_section_id')->unsigned();
            $table->string('other_section')->nullable();

            $table->string('against_persons')->nullable();
            $table->string('public_status')->nullable();
            $table->bigInteger('complaint_status_id')->unsigned()->default(2);
            $table->bigInteger('preliminary_report')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('complainant_id')->references('id')->on('users');
            $table->foreign('preliminary_report')->references('id')->on('files');
            $table->foreign('work_centre_id')->references('id')->on('work_centers');
            $table->foreign('complaint_status_id')->references('id')->on('complaint_statuses');
            $table->foreign('department_section_id')->references('id')->on('center_departments');
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
