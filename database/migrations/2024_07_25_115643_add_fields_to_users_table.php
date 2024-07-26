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
        Schema::table('users', function (Blueprint $table) {
            $table->date('dob')->nullable()->after('phone');
            $table->string('house_number')->nullable()->after('dob');
            $table->string('area')->nullable()->after('house_number');
            $table->string('landmark')->nullable()->after('area');
            $table->string('city')->nullable()->after('landmark');
            $table->string('state')->nullable()->after('city');
            $table->integer('pincode')->nullable()->after('state');
            $table->boolean('phone_verified')->default(false)->after('pincode');
            $table->boolean('email_verified')->default(false)->after('phone_verified');
            $table->integer('phone_otp')->nullable()->after('email_verified');
            $table->integer('email_otp')->nullable()->after('phone_otp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_verified', 'email_verified', 'phone_otp', 'email_otp','dob','house_number','area','landmark','city','state','pincode']);
        });
    }
};
