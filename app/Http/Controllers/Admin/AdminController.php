<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\UserRegistration;
use App\Models\AdminActivityLog;
use App\Http\Controllers\Auth\UserRegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show admin dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::active()->count(),
            'pending_registrations' => UserRegistration::pending()->emailVerified()->count(),
            'recent_activities' => AdminActivityLog::with('user')->recent(7)->latest()->take(10)->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Show users list.
     */
    public function users(Request $request)
    {
        $query = User::with('roles');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->inactive();
            }
        }

        if ($request->filled('role')) {
            $query->withRole($request->role);
        }

        $users = $query->latest()->paginate(15);
        $roles = Role::where('is_active', true)->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show user details.
     */
    public function showUser(User $user)
    {
        $user->load('roles.permissions', 'adminActivityLogs');
        $roles = Role::where('is_active', true)->get();
        $recentActivities = AdminActivityLog::where('model_type', 'App\\Models\\User')
            ->where('model_id', $user->id)
            ->with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.users.show', compact('user', 'roles', 'recentActivities'));
    }

    /**
     * Update user information.
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'username' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'status' => 'required|boolean',
            'notes' => 'nullable|string|max:1000',
        ]);

        $oldValues = $user->toArray();

        $user->update($request->only([
            'name', 'email', 'username', 'phone', 'status', 'notes'
        ]));

        // Log activity
        AdminActivityLog::logActivity(
            auth()->id(),
            'update',
            'App\\Models\\User',
            $user->id,
            $oldValues,
            $user->fresh()->toArray(),
            'Mengupdate informasi user',
            $request->ip(),
            $request->userAgent()
        );

        return back()->with('success', 'Informasi user berhasil diupdate.');
    }

    /**
     * Update user roles.
     */
    public function updateUserRoles(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,name'
        ]);

        $oldRoles = $user->roles->pluck('name')->toArray();
        $newRoles = $request->roles ?? [];

        $user->syncRoles($newRoles, auth()->id());

        // Log activity
        AdminActivityLog::logActivity(
            auth()->id(),
            'assign_role',
            'App\\Models\\User',
            $user->id,
            ['roles' => $oldRoles],
            ['roles' => $newRoles],
            'Mengupdate roles user',
            $request->ip(),
            $request->userAgent()
        );

        return back()->with('success', 'Roles user berhasil diupdate.');
    }

    /**
     * Toggle user status.
     */
    public function toggleUserStatus(User $user)
    {
        $oldStatus = $user->status;
        $newStatus = !$oldStatus;
        
        $user->update(['status' => $newStatus]);

        $action = $newStatus ? 'activate' : 'deactivate';
        $description = $newStatus ? 'Mengaktifkan user' : 'Menonaktifkan user';

        // Log activity
        AdminActivityLog::logActivity(
            auth()->id(),
            $action,
            'App\\Models\\User',
            $user->id,
            ['status' => $oldStatus],
            ['status' => $newStatus],
            $description,
            request()->ip(),
            request()->userAgent()
        );

        $message = $newStatus ? 'User berhasil diaktifkan.' : 'User berhasil dinonaktifkan.';
        return back()->with('success', $message);
    }

    /**
     * Show pending registrations.
     */
    public function pendingRegistrations()
    {
        $registrations = UserRegistration::pending()
            ->emailVerified()
            ->latest()
            ->paginate(15);

        return view('admin.registrations.index', compact('registrations'));
    }

    /**
     * Show registration details.
     */
    public function showRegistration(UserRegistration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    /**
     * Approve registration.
     */
    public function approveRegistration(Request $request, UserRegistration $registration)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        if ($registration->status !== 'pending') {
            return back()->with('error', 'Registrasi ini sudah diproses.');
        }

        $registration->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
            'admin_notes' => $request->admin_notes
        ]);

        // Create user account
        $user = UserRegistrationController::createUserFromRegistration($registration, auth()->id());

        // Log activity
        AdminActivityLog::logActivity(
            auth()->id(),
            'approve',
            'App\\Models\\UserRegistration',
            $registration->id,
            ['status' => 'pending'],
            ['status' => 'approved'],
            'Menyetujui registrasi user',
            $request->ip(),
            $request->userAgent()
        );

        return back()->with('success', 'Registrasi berhasil disetujui dan akun user telah dibuat.');
    }

    /**
     * Reject registration.
     */
    public function rejectRegistration(Request $request, UserRegistration $registration)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        if ($registration->status !== 'pending') {
            return back()->with('error', 'Registrasi ini sudah diproses.');
        }

        $registration->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'admin_notes' => $request->admin_notes
        ]);

        // Log activity
        AdminActivityLog::logActivity(
            auth()->id(),
            'reject',
            'App\\Models\\UserRegistration',
            $registration->id,
            ['status' => 'pending'],
            ['status' => 'rejected'],
            'Menolak registrasi user',
            $request->ip(),
            $request->userAgent()
        );

        return back()->with('success', 'Registrasi berhasil ditolak.');
    }

    /**
     * Show activity logs.
     */
    public function activityLogs(Request $request)
    {
        $query = AdminActivityLog::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('model_type')) {
            $query->where('model_type', $request->model_type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->latest()->paginate(20);
        $users = User::active()->get();
        $actions = AdminActivityLog::distinct()->pluck('action');
        $modelTypes = AdminActivityLog::distinct()->pluck('model_type');

        return view('admin.activity-logs.index', compact('logs', 'users', 'actions', 'modelTypes'));
    }

    /**
     * Show roles management.
     */
    public function roles()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::where('is_active', true)->get()->groupBy('group');

        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Reset user password.
     */
    public function resetUserPassword(User $user)
    {
        $newPassword = Str::random(12);
        $user->update(['password' => Hash::make($newPassword)]);

        // Log activity
        AdminActivityLog::logActivity(
            auth()->id(),
            'update',
            'App\\Models\\User',
            $user->id,
            null,
            null,
            'Reset password user',
            request()->ip(),
            request()->userAgent()
        );

        return back()->with('success', "Password user berhasil direset. Password baru: {$newPassword}");
    }
}