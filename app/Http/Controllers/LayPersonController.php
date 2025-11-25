<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;

class LayPersonController extends Controller
{
    /**
     * Display assignments that have been plotted to the lay person.
     */
    public function assignments()
    {
        $assignments = Pengajuan::latest()
            ->select(['id', 'nomor_pengajuan', 'judul_penelitian', 'status', 'tanggal_submit'])
            ->take(10)
            ->get();

        return view('lay-person.assignments', compact('assignments'));
    }

    /**
     * Display placeholder form hub for lay person input.
     */
    public function forms()
    {
        $assignments = Pengajuan::latest()
            ->select(['id', 'nomor_pengajuan', 'judul_penelitian', 'status'])
            ->take(5)
            ->get();

        return view('lay-person.forms', compact('assignments'));
    }
}
