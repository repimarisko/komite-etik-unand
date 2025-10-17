<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Commands\Seed\SeedCommand;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            // User Management
            'view_users' => ['display_name' => 'View Users', 'description' => 'View users list', 'group' => 'User Management'],
            'create_users' => ['display_name' => 'Create Users', 'description' => 'Create new users', 'group' => 'User Management'],
            'edit_users' => ['display_name' => 'Edit Users', 'description' => 'Edit user information', 'group' => 'User Management'],
            'delete_users' => ['display_name' => 'Delete Users', 'description' => 'Delete users', 'group' => 'User Management'],
            'manage_user_roles' => ['display_name' => 'Manage User Roles', 'description' => 'Manage user roles', 'group' => 'User Management'],
            'reset_user_passwords' => ['display_name' => 'Reset User Passwords', 'description' => 'Reset user passwords', 'group' => 'User Management'],
            
            // Registration Management
            'view_registrations' => ['display_name' => 'View Registrations', 'description' => 'View user registrations', 'group' => 'Registration Management'],
            'approve_registrations' => ['display_name' => 'Approve Registrations', 'description' => 'Approve user registrations', 'group' => 'Registration Management'],
            'reject_registrations' => ['display_name' => 'Reject Registrations', 'description' => 'Reject user registrations', 'group' => 'Registration Management'],
            
            // Role & Permission Management
            'view_roles' => ['display_name' => 'View Roles', 'description' => 'View roles', 'group' => 'Role & Permission Management'],
            'create_roles' => ['display_name' => 'Create Roles', 'description' => 'Create new roles', 'group' => 'Role & Permission Management'],
            'edit_roles' => ['display_name' => 'Edit Roles', 'description' => 'Edit roles', 'group' => 'Role & Permission Management'],
            'delete_roles' => ['display_name' => 'Delete Roles', 'description' => 'Delete roles', 'group' => 'Role & Permission Management'],
            'view_permissions' => ['display_name' => 'View Permissions', 'description' => 'View permissions', 'group' => 'Role & Permission Management'],
            'assign_permissions' => ['display_name' => 'Assign Permissions', 'description' => 'Assign permissions to roles', 'group' => 'Role & Permission Management'],
            
            // Activity Logs
            'view_activity_logs' => ['display_name' => 'View Activity Logs', 'description' => 'View admin activity logs', 'group' => 'Activity Logs'],
            
            // Application Features
            'submit_proposals' => ['display_name' => 'Submit Proposals', 'description' => 'Submit research proposals', 'group' => 'Application Features'],
            'view_proposals' => ['display_name' => 'View Proposals', 'description' => 'View research proposals', 'group' => 'Application Features'],
            'edit_proposals' => ['display_name' => 'Edit Proposals', 'description' => 'Edit research proposals', 'group' => 'Application Features'],
            'review_proposals' => ['display_name' => 'Review Proposals', 'description' => 'Review research proposals', 'group' => 'Application Features'],
            'approve_proposals' => ['display_name' => 'Approve Proposals', 'description' => 'Approve research proposals', 'group' => 'Application Features'],
            'reject_proposals' => ['display_name' => 'Reject Proposals', 'description' => 'Reject research proposals', 'group' => 'Application Features'],
        ];

        foreach ($permissions as $name => $data) {
            Permission::firstOrCreate(
                ['name' => $name],
                [
                    'display_name' => $data['display_name'],
                    'description' => $data['description'],
                    'group' => $data['group']
                ]
            );
        }

        // Create Roles
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin'],
            [
                'display_name' => 'Super Administrator',
                'description' => 'Super Administrator with full access'
            ]
        );

        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'display_name' => 'Administrator',
                'description' => 'Administrator with management access'
            ]
        );

        $reviewerRole = Role::firstOrCreate(
            ['name' => 'reviewer'],
            [
                'display_name' => 'Reviewer',
                'description' => 'Reviewer for research proposals'
            ]
        );

        $userRole = Role::firstOrCreate(
            ['name' => 'user'],
            [
                'display_name' => 'User',
                'description' => 'Regular user who can submit proposals'
            ]
        );

        // Assign permissions to roles
        $allPermissions = Permission::all();
        
        // Super Admin gets all permissions
        $superAdminRole->permissions()->sync($allPermissions->pluck('id'));

        // Admin gets most permissions except some super admin specific ones
        $adminPermissions = $allPermissions->whereNotIn('name', [
            'delete_roles',
            'delete_users'
        ]);
        $adminRole->permissions()->sync($adminPermissions->pluck('id'));

        // Reviewer gets proposal review permissions
        $reviewerPermissions = $allPermissions->whereIn('name', [
            'view_proposals',
            'review_proposals',
            'approve_proposals',
            'reject_proposals'
        ]);
        $reviewerRole->permissions()->sync($reviewerPermissions->pluck('id'));

        // User gets basic permissions
        $userPermissions = $allPermissions->whereIn('name', [
            'submit_proposals',
            'view_proposals',
            'edit_proposals'
        ]);
        $userRole->permissions()->sync($userPermissions->pluck('id'));

        // Create default super admin user
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@komite-etik.unand.ac.id'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'status' => 'active',
                'role' => 'super_admin',
                'phone' => '081234567890',
                'approved_at' => now(),
            ]
        );

        // Assign super admin role
        if (!$superAdmin->roles()->where('role_id', $superAdminRole->id)->exists()) {
            $superAdmin->roles()->attach($superAdminRole->id);
        }

        $this->command->info('Roles and permissions seeded successfully!');
        $this->command->info('Super Admin created: admin@komite-etik.unand.ac.id / password123');
    }
}
