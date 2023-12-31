<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Paginator;


class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
{
    $user = Auth::user();
    $idUser = $user->id;

    $selectedTahun = session('selected_tahun', null);
    $idTahunAjaran = $request->input('tahun', $selectedTahun);
    $laporan = DB::select('CALL 9_MASTER_RAB_GET_DATA_REALISASI(?, ?)', [$idTahunAjaran, $idUser]);

    $tahun = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_DATA(?)', [$idUser]);
    $dropdownOptionsTahun = [];
    foreach ($tahun as $result) {
        $dropdownOptionsTahun[] = $result;
    }
    session(['selected_tahun' => $idTahunAjaran]);
    
    return view('laporan', [
        'user' => $user,
        'idTahunAjaran' => $idTahunAjaran,
        'laporan' => $laporan,
        'dropdownOptionsTahun' => $dropdownOptionsTahun
    ]);
}

    public function cetak(Request $request)
    {
        $user = Auth::user();
        $idUser = $user->id;
        $idTahunAjaran = $request->input('tahun');
        
        $laporan = DB::select('CALL 9_MASTER_RAB_GET_DATA_REALISASI(?, ?)', [$idTahunAjaran, $idUser]);
        $tahun = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_DATA(?)', [$idUser]);


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);

        $pdf = PDF::loadView('pdf.cetak', ['user' => $user, 'idTahunAjaran' => $idTahunAjaran, 'laporan' => $laporan]);

        return $pdf->stream();
    }
}
