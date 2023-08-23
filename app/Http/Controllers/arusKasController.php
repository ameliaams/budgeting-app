<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

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

        $totalVar = 0;
        foreach ($results as $total) {
            $totalVar += $total->DEBET - $total->KREDIT;
        }
        //echo dd($totalVar);

        return view('arusKas', [
            'user' => $user,
            'results' => $results,
            'dropdownOptionsKas' => $dropdownOptionsKas,
            'totalVar' => $totalVar,
        ]);
    }

    public function cetak(Request $request){
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

        $totalVar = 0;
        foreach ($results as $total) {
            $totalVar += $total->DEBET - $total->KREDIT;
        }

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Times New Roman');
        $dompdf = new Dompdf($pdfOptions);
    
        $pdf = PDF::loadView('pdf.cetakArus', [
            'user' => $user,
            'results' => $results,
            'dropdownOptionsKas' => $dropdownOptionsKas,
            'tahun' => $IN_TAHUN,
            'bulan' => $IN_BULAN,
            'kas' => $IN_ID_KAS,
            'totalVar' => $totalVar,
        ]);
    
        return $pdf->stream();
    }
}
