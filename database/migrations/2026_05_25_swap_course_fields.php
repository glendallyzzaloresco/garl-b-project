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
        Schema::table('courses', function (Blueprint $table) {
            // Rename course_name to course_code
            $table->renameColumn('course_name', 'course_code');
        });

        Schema::table('courses', function (Blueprint $table) {
            // Rename description to course_name
            $table->renameColumn('description', 'course_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('course_name', 'description');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('course_code', 'course_name');
        });
    }
};
