<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middle_initial', 5)->nullable();
            $table->string('student_number')->unique();
            $table->string('course');
            $table->string('year_section');
            $table->string('address_brgy');
            $table->string('address_municipal');
            $table->string('address_province');
            $table->string('email_address');
            $table->string('contact_number');
            $table->date('birthday');
            $table->string('sex');
            $table->string('organizational_position');
            $table->string('guardian_names');
            $table->string('guardian_contact_numbers');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
