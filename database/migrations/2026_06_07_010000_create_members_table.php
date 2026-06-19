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
            $table->string('address_brgy')->nullable();
            $table->string('address_municipal')->nullable();
            $table->string('address_province')->nullable();
            $table->string('email_address')->constrained()->cascadeOnDelete();
            $table->string('contact_number')->nullable();
            $table->date('birthday')->nullable();
            $table->string('sex');
            $table->string('organizational_position');
            $table->string('guardian_names')->nullable();
            $table->string('guardian_contact_numbers')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
