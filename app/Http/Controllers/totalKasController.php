<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

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

        $totalVar = 0;
        foreach ($results as $total) {
            $totalVar += $total->TOTAL ;
        }
        //echo dd($totalVar);
        

        return view('laporanTotalKas',
        ['user' => $user,
        'totalVar' => $totalVar, 
        'results' => $results]);
    }
    public function cetak(Request $request)
    {
        $user = Auth::user();
        $IN_TAHUN = $request->input('tahun');
        $IN_BULAN = $request->input('bulan');
        $id_user = Auth::user()->id; 
    
        // Panggil stored procedure dengan parameter
        $results = DB::select('CALL LAPORAN_TOTAL_KAS(?, ?, ?)', [$IN_TAHUN, $IN_BULAN, $id_user]);

        $totalVar = 0;
        foreach ($results as $total) {
            $totalVar += $total->TOTAL ;
        }

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Times New Roman');
        $dompdf = new Dompdf($pdfOptions);
    
        $pdf = PDF::loadView('pdf.cetakTotal', [
            'user' => $user,
            'results' => $results,
            'tahun' => $IN_TAHUN,
            'bulan' => $IN_BULAN,
            'totalVar' => $totalVar, 
        ]);
    
        return $pdf->stream();
    }
}
