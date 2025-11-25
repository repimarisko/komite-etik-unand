<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display daftar pengajuan untuk monitoring lintas role.
     */
    public function index(Request $request)
    {
        $query = Pengajuan::with('user')->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($builder) use ($search) {
                $builder->where('judul_penelitian', 'like', "%{$search}%")
                    ->orWhere('nomor_pengajuan', 'like', "%{$search}%")
                    ->orWhere('peneliti_utama', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $pengajuan = $query->paginate(15)->withQueryString();
        $availableStatuses = Pengajuan::query()
            ->whereNotNull('status')
            ->select('status')
            ->distinct()
            ->pluck('status')
            ->filter()
            ->values();

        return view('admin.pengajuan.index', [
            'pengajuan' => $pengajuan,
            'availableStatuses' => $availableStatuses,
        ]);
    }
}
