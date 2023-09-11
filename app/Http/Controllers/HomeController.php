<?php

namespace App\Http\Controllers;

use App\Models\rab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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

        $data1 = DB::select('CALL CHART_PENGELUARAN(?, ?)', [$idTahunAjaran[0]->ID, $idUser]);
        $dataArray2 = [];
        foreach ($data1 as $result) {
            $dataArray2[] = (array)$result;
        }
        $data = DB::select('CALL 9_MASTER_RAB_GET_DATA(?, ?)', [$idTahunAjaran[0]->ID, $idUser]);

        return view('home', ['user' => $user, 'data' => $data, 'dataArray' => $dataArray, 'dataArray2' => $dataArray2]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $nominal = $request->input('NOMINAL');

        $result = DB::update('CALL 9_MASTER_RAB_UPD(?, ?, ?, ?)', [
            $id, $nominal, 0, 0
        ]);

        if ($result === 1) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
