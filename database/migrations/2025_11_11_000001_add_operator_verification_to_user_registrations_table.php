<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('user_registrations', 'operator_verified_at')) {
                $table->timestamp('operator_verified_at')->nullable()->after('email_verified_at');
            }

            if (!Schema::hasColumn('user_registrations', 'operator_verified_by')) {
                $table->foreignId('operator_verified_by')->nullable()->after('operator_verified_at')->constrained('users');
            }
        });
    }

    public function down(): void
    {
        Schema::table('user_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('user_registrations', 'operator_verified_by')) {
                $table->dropForeign(['operator_verified_by']);
                $table->dropColumn('operator_verified_by');
            }

            if (Schema::hasColumn('user_registrations', 'operator_verified_at')) {
                $table->dropColumn('operator_verified_at');
            }
        });
    }
};
