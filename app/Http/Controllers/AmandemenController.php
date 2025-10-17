<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmandemenController extends Controller
{
    /**
     * Display the amendment form.
     */
    public function index()
    {
        return view('amandemen.index');
    }
    
    /**
     * Store an amendment submission.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nomor_surat_persetujuan' => 'required|string',
            'tanggal_surat' => 'required|date',
            'judul_penelitian_asli' => 'required|string',
            'jenis_amandemen' => 'required|string',
            'detail_amandemen' => 'required|string',
            'alasan_amandemen' => 'required|string',
            'dampak_amandemen' => 'required|string',
            'nama_peneliti_utama' => 'required|string',
            'institusi' => 'required|string',
            'dokumen_amandemen' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);
        
        // Simpan data (untuk saat ini hanya redirect dengan pesan sukses)
        // Nanti bisa ditambahkan penyimpanan ke database
        
        return redirect()->route('amandemen.index')
                        ->with('success', 'Formulir amandemen berhasil dikirim!');
    
    }
}
