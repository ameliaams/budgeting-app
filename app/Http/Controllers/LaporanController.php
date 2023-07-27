<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $idTahunAjaran = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$idUser]);
        $laporan = DB::select('CALL 9_MASTER_RAB_GET_DATA_REALISASI(?, ?)', [$idTahunAjaran[0]->ID, $idUser]);

        return view('laporan', ['user' => $user, 'laporan' => $laporan]);
    }
}
