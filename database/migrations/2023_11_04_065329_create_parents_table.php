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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Fatherinformation
            $table->string('name_fater');
            $table->string('tc_father');
            $table->string('phone_father');
            $table->string('job_father');
            $table->foreignId('nationality_father')->unsigned();
            $table->foreignId('blood_type_father_id')->unsigned();
            $table->string('address_father');

            //Mother information
            $table->string('namemother');
            $table->string('tc_mother');
            $table->string('phone_mother');
            $table->string('job_mother');
            $table->foreignId('nationality_mother')->unsigned();
            $table->foreignId('blood_type_motherr_id')->unsigned();
            $table->string('address_mother');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
