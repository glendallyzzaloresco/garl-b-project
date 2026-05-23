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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_account_id')->unique();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('department')->nullable();
            $table->text('qualifications')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
