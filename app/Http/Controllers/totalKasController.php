<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class totalKasController extends Controller
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
        $id_user = Auth::user()->id; 
    
        // Panggil stored procedure dengan parameter
        $results = DB::select('CALL LAPORAN_TOTAL_KAS(?, ?, ?)', [$IN_TAHUN, $IN_BULAN, $id_user]);
    
        return view('laporanTotalKas', ['user' => $user, 'results' => $results]);
    }
}
