<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerpanjanganController extends Controller
{
    public function index()
    {
        return view('perpanjangan.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat_persetujuan' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'judul_penelitian' => 'required|string',
            'nama_peneliti_utama' => 'required|string|max:255',
            'institusi' => 'required|string|max:255',
            'tanggal_mulai_awal' => 'required|date',
            'tanggal_selesai_awal' => 'required|date',
            'tanggal_selesai_baru' => 'required|date|after:tanggal_selesai_awal',
            'durasi_perpanjangan' => 'required|integer|min:1',
            'alasan_perpanjangan' => 'required|string',
            'justifikasi_perpanjangan' => 'required|string',
            'dampak_perpanjangan' => 'nullable|string',
            'perubahan_metodologi' => 'nullable|string',
            'status_rekrutmen' => 'required|string',
            'jumlah_subjek_saat_ini' => 'required|integer|min:0',
            'rencana_tambahan_subjek' => 'nullable|integer|min:0',
            'dokumen_perpanjangan' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Process the form data here
        // For now, just redirect with success message
        
        return redirect()->route('perpanjangan.index')
            ->with('success', 'Permohonan perpanjangan penelitian berhasil diajukan!');
    }
}
