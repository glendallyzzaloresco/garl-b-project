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
        Schema::table('user_accounts', function (Blueprint $table) {
            if (!Schema::hasColumn('user_accounts', 'password_changed')) {
                $table->boolean('password_changed')->default(false)->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            if (Schema::hasColumn('user_accounts', 'password_changed')) {
                $table->dropColumn('password_changed');
            }
        });
    }
};
