<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->renameColumn('year_section', 'year');
            $table->string('section')->nullable()->after('year');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->renameColumn('year', 'year_section');
            $table->dropColumn('section');
        });
    }
};
