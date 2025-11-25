<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {email=admin@admin.com} {password=admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Check if user already exists
        if (User::where('email', $email)->exists()) {
            $this->error("User with email {$email} already exists!");
            return 1;
        }

        // Ensure core roles exist
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin'],
            [
                'display_name' => 'Super Administrator',
                'description' => 'Super Administrator with complete system control'
            ]
        );

        $operatorRole = Role::firstOrCreate(
            ['name' => 'operator'],
            [
                'display_name' => 'Operator',
                'description' => 'Operator yang mengelola user dan eksport data'
            ]
        );

        // Create admin user
        $user = User::create([
            'name' => 'Administrator',
            'email' => $email,
            'password' => Hash::make($password),
            'username' => 'admin',
            'phone' => '081234567890',
            'status' => 'active',
            'role' => 'super_admin',
            'approved_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Assign admin role
        $user->assignRole('super_admin');
        $user->assignRole('operator');

        $this->info("Admin user created successfully!");
        $this->info("Email: {$email}");
        $this->info("Password: {$password}");
        $this->info("Roles: super_admin, operator");

        return 0;
    }
}
