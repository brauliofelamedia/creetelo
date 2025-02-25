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
            $table->string('phone')->nullable()->after('email');
            $table->boolean('is_email')->default(false)->after('phone');
            $table->string('password_assign_token')->nullable()->after('is_email');
            $table->timestamp('password_assign_expires_at')->nullable()->after('password_assign_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('is_email');
            $table->dropColumn('password_assign_token');
            $table->dropColumn('password_assign_expires_at');
        });
    }
};
