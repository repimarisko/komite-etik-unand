<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PengajuanBaruController extends Controller
{
    /**
     * Display the new submission form.
     */
    public function index()
    {
        return view('pengajuan-baru.index');
    }
    
    /**
     * Store a new submission.
     */
    public function store(Request $request)
    {
        // Log semua data yang diterima untuk debugging
        Log::info('Data form yang diterima:', [
            'all_data' => $request->all(),
            'method' => $request->method(),
            'url' => $request->url()
        ]);
        
        try {
            // Validasi input
            $validated = $request->validate([
                'anda_civitas_unand' => 'required|string',
                'fakultas' => 'required|string',
                'penunjukan' => 'required|string',
                'jenjang' => 'required|string',
                'kelompok' => 'required|string',
                'multisenter' => 'required|string',
                'senter_penelitian_utama' => 'nullable|string',
                'satelit' => 'nullable|string',
                'penyandang_dana' => 'required|string',
                'sebut_detailnya' => 'nullable|string',
                'judul_penelitian' => 'required|string',
                'lokasi_penelitian' => 'required|string',
               // 'instansi_pengusul' => 'required|string',
                'prodi_departemen' => 'required|string',
                'nama_fakultas' => 'required|string',
                'nama_universitas' => 'required|string',
                'alamat_institusi' => 'required|string',
                'nama_peneliti_utama' => 'required|string',
                'nama_kontak_person' => 'required|string',
                'periode_penelitian' => 'required|string',
                'jumlah_subjek' => 'required|string',
                'jenis_hewan' => 'nullable|string',
                'jenis_data' => 'required|string',
                'metode_penelitian' => 'required|string',
                'terikat_penelitian_dosen' => 'required|string',
                'nama_dosen' => 'nullable|string',
                'peran' => 'nullable|string',
                'jika_lainnya' => 'nullable|string',
                'judul_penelitian_payung' => 'nullable|string',
                'apakah_ada_pembimbing' => 'required|string',
                'nama_pembimbing' => 'nullable|string',
                'pembimbing_data' => 'nullable|string'
            ]);
            
            Log::info('Validasi berhasil:', ['validated_data' => $validated]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validasi gagal:', [
                'errors' => $e->errors(),
                'input_data' => $request->all(),
                'failed_rules' => $e->validator->failed()
            ]);
            
            return redirect()->back()
                            ->withErrors($e->errors())
                            ->withInput()
                            ->with('debug_message', 'Validation failed - check logs for details')
                            ->with('validation_errors', $e->errors());
        }
        
        // Proses data pembimbing jika ada
        $pembimbingData = [];
        try {
            if ($request->has('pembimbing_data') && !empty($request->pembimbing_data)) {
                Log::info('Memproses data pembimbing:', ['raw_data' => $request->pembimbing_data]);
                
                $pembimbingData = json_decode($request->pembimbing_data, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::error('Error parsing JSON pembimbing:', [
                        'json_error' => json_last_error_msg(),
                        'raw_data' => $request->pembimbing_data
                    ]);
                    
                    return redirect()->back()
                        ->withInput()
                        ->withErrors([
                            'pembimbing_data' => 'Format data pembimbing tidak valid: ' . json_last_error_msg(),
                            'error_debug' => 'JSON Error: ' . json_last_error_msg()
                        ]);
                }
            }
            
            // Log data pembimbing untuk debugging
            Log::info('Data pembimbing yang diterima:', [
                'pembimbing_count' => count($pembimbingData),
                'pembimbing_data' => $pembimbingData
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error saat memproses data pembimbing:', [
                'error' => $e->getMessage(),
                'raw_data' => $request->pembimbing_data ?? 'null'
            ]);
            
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'pembimbing_data' => 'Error memproses data pembimbing: ' . $e->getMessage(),
                    'error_debug' => 'Pembimbing processing error: ' . $e->getMessage()
                ]);
        }
        
        // Simpan data ke database dengan transaction
        try {
            DB::beginTransaction();
            
            Log::info('Memulai proses penyimpanan data pengajuan');
            
            // Generate nomor pengajuan unik
            $currentCount = Pengajuan::whereYear('created_at', date('Y'))->count();
            $nomorPengajuan = 'ETK-' . date('Y') . '-' . str_pad($currentCount + 1, 4, '0', STR_PAD_LEFT);
            
            Log::info('Nomor pengajuan generated:', [
                'nomor_pengajuan' => $nomorPengajuan,
                'current_count' => $currentCount
            ]);
            
            // Siapkan data untuk disimpan
            $pengajuanData = [
                'nomor_pengajuan' => $nomorPengajuan,
                'jenis_pengajuan' => 'baru',
                'judul_penelitian' => $validated['judul_penelitian'],
                'peneliti_utama' => $validated['nama_peneliti_utama'],
                'institusi' => $validated['nama_universitas'],
                'email' => $validated['nama_kontak_person'], // Asumsi email ada di kontak person
                'telepon' => '', // Bisa ditambahkan field telepon di form
                'anggota_peneliti' => '', // Bisa ditambahkan jika ada
                'pembimbing_data' => $pembimbingData,
                'nama_pembimbing' => $validated['nama_pembimbing'] ?? '',
                'lokasi_penelitian' => $validated['lokasi_penelitian'],
                'metode_penelitian' => $validated['metode_penelitian'],
                'abstrak' => '', // Bisa ditambahkan field abstrak di form
                'populasi_sampel' => $validated['jumlah_subjek'],
                'risiko_manfaat' => '', // Bisa ditambahkan field ini di form
                'informed_consent' => '', // Bisa ditambahkan field ini di form
                'tanggal_mulai' => now(), // Bisa ditambahkan field tanggal di form
                'tanggal_selesai' => now()->addMonths(12), // Default 1 tahun
                'status' => 'draft',
                'tanggal_submit' => now(),
                'user_id' => 1 // Default user, nanti bisa disesuaikan dengan auth
            ];
            
            Log::info('Data pengajuan yang akan disimpan:', [
                'pengajuan_data' => $pengajuanData,
                'data_size' => count($pengajuanData)
            ]);
            
            // Simpan ke database
            Log::info('Mencoba menyimpan ke database...');
            $pengajuan = Pengajuan::create($pengajuanData);
            
            // Log sukses
            Log::info('Pengajuan berhasil disimpan:', [
                'pengajuan_id' => $pengajuan->id,
                'nomor_pengajuan' => $pengajuan->nomor_pengajuan,
                'pembimbing_count' => count($pembimbingData),
                'created_at' => $pengajuan->created_at
            ]);
            
            DB::commit();
            
            return redirect()->route('pengajuan-baru.index')
                            ->with('success', 'Formulir pengajuan berhasil dikirim dengan nomor: ' . $nomorPengajuan);
                            
        } catch (\Exception $e) {
            DB::rollback();
            
            // Log error dengan detail lengkap
            Log::error('Gagal menyimpan pengajuan:', [
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'pengajuan_data' => $pengajuanData ?? 'Data belum terbentuk',
                'validated_data' => $validated ?? 'Validasi belum selesai'
            ]);
            
            // Tentukan pesan error yang lebih spesifik
            $errorMessage = 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage();
            
            // Jika error database
            if (strpos($e->getMessage(), 'SQLSTATE') !== false) {
                $errorMessage = 'Error database: ' . $e->getMessage();
            }
            
            // Jika error validasi model
            if (strpos($e->getMessage(), 'Mass Assignment') !== false) {
                $errorMessage = 'Error mass assignment: Field tidak diizinkan untuk diisi. ' . $e->getMessage();
            }
            
            return redirect()->back()
                            ->withInput()
                            ->withErrors([
                                'error' => $errorMessage,
                                'error_debug' => 'Detail error: ' . $e->getMessage() . ' di file ' . $e->getFile() . ' baris ' . $e->getLine()
                            ])
                            ->with('debug_message', 'Exception occurred - check logs for details')
                            ->with('exception_details', [
                                'message' => $e->getMessage(),
                                'file' => $e->getFile(),
                                'line' => $e->getLine(),
                                'code' => $e->getCode()
                            ]);
        }
    }
}
