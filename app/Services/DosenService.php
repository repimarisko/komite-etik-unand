<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DosenService
{
    private $apiUrl;
    private $apiKey;

    public function __construct()
    {
        $this->apiUrl = 'https://sippmi.unand.ac.id/apiSippmi/dosen.php';
        $this->apiKey = env('SIPPMI_API_KEY', 'AbC123xYz9');
    }

    /**
     * Get dosen data from SIPPMI API
     *
     * @return array
     */
    public function getDosenData()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->withOptions([
                'verify' => false, // Disable SSL verification
                'timeout' => 30
            ])->get($this->apiUrl);

            if ($response->successful()) {
                $responseData = $response->json();
                
                // Handle new API response structure
                if (is_array($responseData) && isset($responseData['dosen']) && isset($responseData['prodi'])) {
                    // Map prodi data for easier lookup
                    $prodiMap = [];
                    if (is_array($responseData['prodi'])) {
                        foreach ($responseData['prodi'] as $prodi) {
                            if (is_array($prodi) && isset($prodi['id']) && isset($prodi['prodi'])) {
                                $prodiMap[$prodi['id']] = $prodi['prodi'];
                            }
                        }
                    }
                    
                    // Enhance dosen data with prodi names
                    $dosenData = [];
                    if (is_array($responseData['dosen'])) {
                        foreach ($responseData['dosen'] as $dosen) {
                            if (is_array($dosen)) {
                                $dosen['prodi_name'] = isset($dosen['prodi']) && isset($prodiMap[$dosen['prodi']]) 
                                    ? $prodiMap[$dosen['prodi']] 
                                    : 'Unknown';
                                $dosenData[] = $dosen;
                            }
                        }
                    }
                    
                    return [
                        'success' => true,
                        'data' => $dosenData,
                        'prodi' => $responseData['prodi'],
                        'message' => $responseData['message'] ?? 'Data dosen berhasil diambil'
                    ];
                } else {
                    // Fallback for old structure or handle array data directly
                    $data = is_array($responseData) ? $responseData : [];
                    return [
                        'success' => true,
                        'data' => $data,
                        'message' => 'Data dosen berhasil diambil'
                    ];
                }
            } else {
                Log::error('Failed to fetch dosen data', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);

                return [
                    'success' => false,
                    'data' => null,
                    'message' => 'Gagal mengambil data dosen: ' . $response->status()
                ];
            }
        } catch (\Exception $e) {
            Log::error('Exception when fetching dosen data', [
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Search dosen by name or NIDN
     *
     * @param string $query
     * @return array
     */
    public function searchDosen($query = '')
    {
        $dosenData = $this->getDosenData();
        
        if (!$dosenData['success']) {
            return $dosenData;
        }

        $data = $dosenData['data'];
        
        if (empty($query)) {
            return $dosenData;
        }

        // Filter data based on query
        $filteredData = array_filter($data, function($dosen) use ($query) {
            return stripos($dosen['nama'] ?? '', $query) !== false || 
                   stripos($dosen['nidn'] ?? '', $query) !== false;
        });

        return [
            'success' => true,
            'data' => array_values($filteredData),
            'message' => 'Data dosen berhasil difilter'
        ];
    }
}