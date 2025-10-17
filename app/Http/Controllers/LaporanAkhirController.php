<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanAkhirController extends Controller
{
    /**
     * Display the final report form.
     */
    public function index()
    {
        return view('laporan-akhir.index');
    }
    
    /**
     * Store a final report submission.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nomor_surat_persetujuan' => 'required|string',
            'tanggal_surat' => 'required|date',
            'judul_penelitian' => 'required|string',
            'nama_peneliti_utama' => 'required|string',
            'institusi' => 'required|string',
            'tanggal_mulai_penelitian' => 'required|date',
            'tanggal_selesai_penelitian' => 'required|date',
            'status_penelitian' => 'required|string',
            'jumlah_subjek_target' => 'required|integer',
            'jumlah_subjek_tercapai' => 'required|integer',
            'ringkasan_hasil' => 'required|string',
            'kendala_penelitian' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
            'publikasi_rencana' => 'required|string',
            'dokumen_laporan' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
        ]);
        
        // Simpan data (untuk saat ini hanya redirect dengan pesan sukses)
        // Nanti bisa ditambahkan penyimpanan ke database
        
        return redirect()->route('laporan-akhir.index')
                        ->with('success', 'Laporan akhir berhasil dikirim!');
    }
}
