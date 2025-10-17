<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KtdSae;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KtdSaeController extends Controller
{
    public function index()
    {
        return view('ktd-sae.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat_persetujuan' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'judul_penelitian' => 'required|string',
            'nama_peneliti_utama' => 'required|string|max:255',
            'institusi' => 'required|string|max:255',
            'jenis_laporan' => 'required|in:ktd,sae',
            'tanggal_kejadian' => 'required|date',
            'waktu_kejadian' => 'nullable|string',
            'lokasi_kejadian' => 'required|string|max:255',
            'deskripsi_kejadian' => 'required|string',
            'subjek_terlibat' => 'required|string|max:255',
            'usia_subjek' => 'nullable|integer|min:0|max:150',
            'jenis_kelamin_subjek' => 'nullable|in:laki-laki,perempuan',
            'kondisi_medis_subjek' => 'nullable|string',
            'tingkat_keparahan' => 'required|in:ringan,sedang,berat,mengancam_jiwa,fatal',
            'hubungan_dengan_penelitian' => 'required|in:pasti_terkait,mungkin_terkait,tidak_terkait,tidak_dapat_dinilai',
            'tindakan_segera' => 'required|string',
            'tindakan_korektif' => 'nullable|string',
            'tindakan_preventif' => 'nullable|string',
            'status_subjek' => 'required|in:pulih_sempurna,pulih_dengan_gejala_sisa,belum_pulih,memburuk,meninggal,tidak_diketahui',
            'dilaporkan_ke_sponsor' => 'required|boolean',
            'tanggal_laporan_sponsor' => 'nullable|date',
            'dilaporkan_ke_otoritas' => 'required|boolean',
            'tanggal_laporan_otoritas' => 'nullable|date',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'pelapor_nama' => 'required|string|max:255',
            'pelapor_jabatan' => 'required|string|max:255',
            'pelapor_kontak' => 'required|string|max:255',
        ]);

        try {
            // Generate nomor laporan
            $nomorLaporan = 'KTD-SAE-' . date('Y') . '-' . str_pad(KtdSae::count() + 1, 4, '0', STR_PAD_LEFT);
            
            // Handle file upload
            $dokumenPendukung = null;
            if ($request->hasFile('dokumen_pendukung')) {
                $file = $request->file('dokumen_pendukung');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('ktd-sae', $fileName, 'public');
                $dokumenPendukung = [$filePath];
            }
            
            // Map hubungan_dengan_penelitian values
            $hubunganMapping = [
                'pasti_terkait' => 'pasti',
                'mungkin_terkait' => 'mungkin',
                'tidak_terkait' => 'tidak_berhubungan',
                'tidak_dapat_dinilai' => 'kemungkinan_kecil'
            ];
            
            // Prepare data for saving
            $data = [
                'nomor_laporan' => $nomorLaporan,
                'pengajuan_id' => 1, // Default value, bisa disesuaikan
                'jenis_kejadian' => $request->jenis_laporan,
                'judul_penelitian' => $request->judul_penelitian,
                'peneliti_utama' => $request->nama_peneliti_utama,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'waktu_kejadian' => $request->waktu_kejadian,
                'deskripsi_kejadian' => $request->deskripsi_kejadian,
                'lokasi_kejadian' => $request->lokasi_kejadian,
                'subjek_terlibat' => $request->subjek_terlibat,
                'kondisi_subjek_sebelum' => $request->kondisi_medis_subjek ?? 'Tidak ada informasi',
                'kondisi_subjek_sesudah' => $request->status_subjek,
                'tingkat_keparahan' => $request->tingkat_keparahan,
                'tindakan_yang_diambil' => $request->tindakan_segera,
                'hasil_tindakan' => $request->tindakan_korektif ?? 'Tidak ada tindakan korektif',
                'hubungan_dengan_penelitian' => $hubunganMapping[$request->hubungan_dengan_penelitian] ?? 'tidak_berhubungan',
                'analisis_penyebab' => 'Perlu analisis lebih lanjut',
                'tindakan_pencegahan' => $request->tindakan_preventif ?? 'Tidak ada tindakan preventif',
                'dokumen_pendukung' => $dokumenPendukung,
                'status' => 'submitted',
                'tanggal_submit' => now(),
                'user_id' => 1 // Default admin user
            ];
            
            // Save to database
            $ktdSae = KtdSae::create($data);
            
            return redirect()->route('ktd-sae.index')
                ->with('success', 'Laporan KTD/SAE berhasil diajukan dengan nomor: ' . $nomorLaporan);
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan laporan: ' . $e->getMessage());
        }
    }
}
