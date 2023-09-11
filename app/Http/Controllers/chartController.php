<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class chartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $idUser = auth()->user()->id;
        $idTahunAjaran = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$idUser]);

        $results = DB::select('CALL CHART_PENDAPATAN(?, ?)', [$idTahunAjaran[0]->ID, $idUser]);
        $dataArray = [];
        foreach ($results as $result) {
            $dataArray[] = (array)$result;
        }

        $data = DB::select('CALL CHART_PENGELUARAN(?, ?)', [$idTahunAjaran[0]->ID, $idUser]);
        $dataArray2 = [];
        foreach ($data as $result) {
            $dataArray2[] = (array)$result;
        }

        return view('chart', ['dataArray' => $dataArray, 'dataArray2' => $dataArray2, 'user' => $user]);
    }
}
