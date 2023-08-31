<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RabController extends Controller
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

        $idUser = $user->id;
        $idTahunAjaran = $request->input('tahun');

        //echo dd($idTahunAjaran);
        //$idTahunAjaran = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$idUser]);
        $tahun = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_DATA(?)', [$idUser]);
        $data = DB::select('CALL 9_MASTER_RAB_GET_DATA(?, ?)', [$idTahunAjaran, $idUser]);

        //echo dd($tahun);

        //echo dd($idTahunAjaran[0]->ID);
        $dropdownOptionsTahun = [];
        foreach ($tahun as $result) {
            $dropdownOptionsTahun[] = $result;
        }

        return view('rab', ['user' => $user, 'data' => $data, 'tahun' => $tahun, 'dropdownOptionsTahun' => $dropdownOptionsTahun]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $id = $request->input('id');
        $nominal = $request->input('NOMINAL');
        $editMode = true;

        try {

            $result = DB::update('CALL 9_MASTER_RAB_UPD(?, ?)', [
                $id, $nominal
            ]);

            if ($result === 1) {
                // Update successful

                // Fetch the updated data
                $idUser = $user->id;
                $idTahunAjaran = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$idUser]);
                $data = DB::select('CALL 9_MASTER_RAB_GET_DATA(?, ?)', [$idTahunAjaran[0]->ID, $idUser]);

                return response()->json(['success' => true, 'data' => $data]);
            } else {
                // Update failed
                return response()->json(['success' => false, 'message' => 'Update failed']);
            }
        } catch (\Exception $e) {
            // Handle the exception if the update fails
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function sync(Request $request)
    {
        $user = Auth::user();

        $idUser = $user->id;
        $idTahunAjaran = $request->input('tahun');
        // Call the stored procedure and fetch the data
        $tes = "CALL UPD_TOTAL_NOMINAL_RAB_ALL(" . $idUser . ", " . $idTahunAjaran[0]->ID . ")";

        echo dd($tes);

        $data = DB::select('CALL UPD_TOTAL_NOMINAL_RAB_ALL(?, ?)', [$idUser, $idTahunAjaran[0]->ID]);
        $data = DB::select('CALL 9_MASTER_RAB_GET_DATA(?, ?)', [$idTahunAjaran[0]->ID, $idUser]);
        $tahun = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_DATA(?)', [$idUser]);

        $dropdownOptionsTahun = [];
        foreach ($tahun as $result) {
            // Assuming you have a property named NAMA_KAS in the results
            $dropdownOptionsTahun[] = $result;
        }

        // echo dd($dropdownOptionsTahun)
        return view('rab', ['user' => $user, 'data' => $data, 'tahun' => $tahun, 'dropdownOptionsTahun' => $dropdownOptionsTahun,]);
    }
}