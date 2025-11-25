<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\User;

class PlottingController extends Controller
{
    /**
     * Display simple plotting board to pair lay person reviewers and pengajuan.
     */
    public function index()
    {
        $layPersons = User::withRole('lay_person')
            ->withCount('adminActivityLogs')
            ->latest()
            ->get();

        $pengajuan = Pengajuan::latest()
            ->take(10)
            ->get();

        return view('admin.plotting.index', compact('layPersons', 'pengajuan'));
    }
}
