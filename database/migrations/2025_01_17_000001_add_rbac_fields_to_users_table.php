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
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending')->after('email_verified_at');
            $table->string('role')->default('user')->after('status');
            $table->timestamp('approved_at')->nullable()->after('role');
            $table->foreignId('approved_by')->nullable()->constrained('users')->after('approved_at');
            $table->text('notes')->nullable()->after('approved_by');
            $table->string('verification_token')->nullable()->after('notes');
            $table->timestamp('last_login_at')->nullable()->after('verification_token');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn([
                'username',
                'phone',
                'status',
                'role',
                'approved_at',
                'approved_by',
                'notes',
                'verification_token',
                'last_login_at',
                'last_login_ip'
            ]);
        });
    }
};