<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\User;

class ExportController extends Controller
{
    /**
     * Show export utilities summary page.
     */
    public function index()
    {
        $stats = [
            'total_pengajuan' => Pengajuan::count(),
            'pengajuan_selesai' => Pengajuan::where('status', 'approved')->count(),
            'total_user' => User::count(),
            'total_lay_person' => User::withRole('lay_person')->count(),
            'total_pengusul' => User::withRole('pengusul_etik')->count(),
        ];

        return view('admin.exports.index', compact('stats'));
    }
}
