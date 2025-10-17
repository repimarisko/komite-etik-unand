<?php

namespace App\Http\Controllers;

use App\Services\DosenService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DosenController extends Controller
{
    private $dosenService;

    public function __construct(DosenService $dosenService)
    {
        $this->dosenService = $dosenService;
    }

    /**
     * Get all dosen data
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = $this->dosenService->getDosenData();
        
        return response()->json($result, $result['success'] ? 200 : 500);
    }

    /**
     * Search dosen by name or NIDN
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        $result = $this->dosenService->searchDosen($query);
        
        return response()->json($result, $result['success'] ? 200 : 500);
    }

    /**
     * Display dosen data in a view (for testing)
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $result = $this->dosenService->getDosenData();
        
        return view('dosen.index', compact('result'));
    }
}