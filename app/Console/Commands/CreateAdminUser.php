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

        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'display_name' => 'Administrator',
                'description' => 'System Administrator with full access'
            ]
        );

        // Create super_admin role if it doesn't exist
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin'],
            [
                'display_name' => 'Super Administrator',
                'description' => 'Super Administrator with complete system control'
            ]
        );

        // Create admin user
        $user = User::create([
            'name' => 'Administrator',
            'email' => $email,
            'password' => Hash::make($password),
            'username' => 'admin',
            'phone' => '081234567890',
            'status' => true,
            'role' => 'admin',
            'approved_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Assign admin role
        $user->assignRole('admin');
        $user->assignRole('super_admin');

        $this->info("Admin user created successfully!");
        $this->info("Email: {$email}");
        $this->info("Password: {$password}");
        $this->info("Roles: admin, super_admin");

        return 0;
    }
}