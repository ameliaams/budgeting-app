<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class arusKasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $IN_TAHUN = $request->input('tahun');
        $IN_BULAN = $request->input('bulan');
        $IN_ID_KAS = $request->input('kas');
        $IN_ID_USER = auth()->user()->id;

        // Call the stored procedure
        $results = DB::select('CALL LAPORAN_ARUS_KAS(?, ?, ?)', [$IN_TAHUN, $IN_BULAN, $IN_ID_KAS]);

        $resultsKas = DB::select('CALL 9_master_kas_get_data(?)', [$IN_ID_USER]);
        $dropdownOptionsKas = [];
        foreach ($resultsKas as $result) {
            $dropdownOptionsKas[] = $result;
        }

        return view('arusKas', [
            'user' => $user,
            'results' => $results,
            'dropdownOptionsKas' => $dropdownOptionsKas,
        ]);

    }
}
