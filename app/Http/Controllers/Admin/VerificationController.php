<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\UserRegistration;

class VerificationController extends Controller
{
    /**
     * Menampilkan ringkasan data yang membutuhkan verifikasi.
     */
    public function index()
    {
        $pendingPengajuan = Pengajuan::query()
            ->whereIn('status', ['draft', 'submitted', 'review'])
            ->latest()
            ->paginate(10);

        $pendingRegistrations = UserRegistration::pending()
            ->latest()
            ->paginate(10);

        return view('admin.verifications.index', [
            'pendingPengajuan' => $pendingPengajuan,
            'pendingRegistrations' => $pendingRegistrations,
        ]);
    }
}
