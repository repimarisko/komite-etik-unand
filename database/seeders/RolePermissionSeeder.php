<?php

namespace Database\Seeders;

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
        $permissions = [
            'view_monitoring' => [
                'display_name' => 'Monitoring Data',
                'description' => 'Melihat statistik dashboard dan monitoring',
                'group' => 'Monitoring'
            ],
            'view_pengajuan_list' => [
                'display_name' => 'Daftar Pengajuan',
                'description' => 'Mengakses daftar lengkap pengajuan etik',
                'group' => 'Pengajuan'
            ],
            'verify_pengajuan' => [
                'display_name' => 'Verifikasi Pengajuan',
                'description' => 'Memverifikasi dan menilai pengajuan etik',
                'group' => 'Pengajuan'
            ],
            'export_pengajuan' => [
                'display_name' => 'Export Data Pengajuan',
                'description' => 'Mengunduh data pengajuan dan laporan',
                'group' => 'Operasional'
            ],
            'view_users' => [
                'display_name' => 'Melihat User',
                'description' => 'Melihat dan mencari data user',
                'group' => 'User'
            ],
            'verify_users' => [
                'display_name' => 'Verifikasi User',
                'description' => 'Memverifikasi registrasi dan status user',
                'group' => 'User'
            ],
            'plot_lay_person' => [
                'display_name' => 'Plotting Lay Person',
                'description' => 'Menugaskan lay person ke pengajuan tertentu',
                'group' => 'Operasional'
            ],
            'fill_lay_person_forms' => [
                'display_name' => 'Isi Form Lay Person',
                'description' => 'Mengisi formulir review sesuai penugasan',
                'group' => 'Lay Person'
            ],
            'submit_pengajuan' => [
                'display_name' => 'Ajukan Usulan Etik',
                'description' => 'Mengirimkan usulan etik baru',
                'group' => 'Pengusul'
            ],
            'access_pengajuan_forms' => [
                'display_name' => 'Akses Form Pengajuan/Pelaporan',
                'description' => 'Mengakses seluruh formulir pengajuan dan pelaporan',
                'group' => 'Pengusul'
            ],
            'view_lay_person_inputs' => [
                'display_name' => 'Lihat Isian Lay Person',
                'description' => 'Mengakses catatan dari lay person',
                'group' => 'Pengusul'
            ],
        ];

        foreach ($permissions as $name => $meta) {
            Permission::firstOrCreate(
                ['name' => $name],
                [
                    'display_name' => $meta['display_name'],
                    'description' => $meta['description'],
                    'group' => $meta['group'],
                ]
            );
        }

        $roles = [
            'super_admin' => [
                'display_name' => 'Super Admin',
                'description' => 'Mengelola seluruh modul tanpa batasan akses',
            ],
            'verifikator' => [
                'display_name' => 'Verifikator',
                'description' => 'Memverifikasi pengajuan, memonitor data, dan plotting lay person',
            ],
            'lay_person' => [
                'display_name' => 'Lay Person',
                'description' => 'Reviewer masyarakat yang mengisi formulir penilaian',
            ],
            'pengusul_etik' => [
                'display_name' => 'Pengusul Etik',
                'description' => 'Peneliti/pengusul yang mengajukan proposal etik',
            ],
            'operator' => [
                'display_name' => 'Operator',
                'description' => 'Mengelola user, verifikasi registrasi, dan eksport data',
            ],
        ];

        foreach ($roles as $name => $meta) {
            Role::firstOrCreate(
                ['name' => $name],
                [
                    'display_name' => $meta['display_name'],
                    'description' => $meta['description'],
                ]
            );
        }

        $rolePermissions = [
            'super_admin' => array_keys($permissions),
            'verifikator' => [
                'view_monitoring',
                'view_pengajuan_list',
                'verify_pengajuan',
                'export_pengajuan',
                'view_users',
                'verify_users',
                'plot_lay_person',
            ],
            'lay_person' => [
                'view_pengajuan_list',
                'fill_lay_person_forms',
            ],
            'pengusul_etik' => [
                'submit_pengajuan',
                'access_pengajuan_forms',
                'view_lay_person_inputs',
            ],
            'operator' => [
                'view_monitoring',
                'view_pengajuan_list',
                'view_users',
                'verify_users',
                'export_pengajuan',
            ],
        ];

        $permissionsByName = Permission::all()->keyBy('name');

        foreach ($rolePermissions as $roleName => $permissionNames) {
            $role = Role::where('name', $roleName)->first();
            if (!$role) {
                continue;
            }

            $permissionIds = collect($permissionNames)
                ->map(fn ($permission) => $permissionsByName[$permission]->id ?? null)
                ->filter()
                ->values();

            $role->permissions()->sync($permissionIds);
        }

        $defaultUsers = [
            [
                'name' => 'Super Administrator',
                'email' => 'superadmin@komite-etik.unand.ac.id',
                'username' => 'superadmin',
                'phone' => '081200000001',
                'role' => 'super_admin',
                'password' => 'password123',
            ],
            [
                'name' => 'Verifikator Utama',
                'email' => 'verifikator@komite-etik.unand.ac.id',
                'username' => 'verifikator',
                'phone' => '081200000002',
                'role' => 'verifikator',
                'password' => 'password123',
            ],
            [
                'name' => 'Lay Person Panel',
                'email' => 'layperson@komite-etik.unand.ac.id',
                'username' => 'layperson',
                'phone' => '081200000003',
                'role' => 'lay_person',
                'password' => 'password123',
            ],
            [
                'name' => 'Pengusul Etik Demo',
                'email' => 'pengusul@komite-etik.unand.ac.id',
                'username' => 'pengusul',
                'phone' => '081200000004',
                'role' => 'pengusul_etik',
                'password' => 'password123',
            ],
            [
                'name' => 'Operator Komite',
                'email' => 'operator@komite-etik.unand.ac.id',
                'username' => 'operator',
                'phone' => '081200000005',
                'role' => 'operator',
                'password' => 'password123',
            ],
        ];

        foreach ($defaultUsers as $account) {
            $user = User::firstOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'username' => $account['username'],
                    'password' => Hash::make($account['password']),
                    'phone' => $account['phone'],
                    'status' => 'active',
                    'role' => $account['role'],
                    'approved_at' => now(),
                    'email_verified_at' => now(),
                ]
            );

            $user->assignRole($account['role']);
        }

        $this->command->info('Roles, permissions, dan akun default berhasil dibuat.');
    }
}
