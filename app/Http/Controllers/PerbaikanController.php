<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    /**
     * Display the correction form.
     */
    public function index()
    {
        return view('perbaikan.index');
    }
    
    /**
     * Store a correction submission.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nomor_surat_persetujuan' => 'required|string',
            'tanggal_surat' => 'required|date',
            'judul_penelitian_asli' => 'required|string',
            'judul_penelitian_perbaikan' => 'required|string',
            'alasan_perbaikan' => 'required|string',
            'bagian_yang_diperbaiki' => 'required|string',
            'nama_peneliti_utama' => 'required|string',
            'institusi' => 'required|string',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);
        
        // Simpan data (untuk saat ini hanya redirect dengan pesan sukses)
        // Nanti bisa ditambahkan penyimpanan ke database
        
        return redirect()->route('perbaikan.index')
                        ->with('success', 'Formulir perbaikan berhasil dikirim!');
    }
}
