<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $inSearch = '%%';
        $idUser = $user->id;

        // Call the stored procedure and fetch the data
        $data = DB::select('CALL 9_MASTER_COA_GET_DATA(?, ?)', [$inSearch, $idUser]);

        return view('coa', ['user' => $user, 'data' => $data]);
    }

    public function addData(Request $request)
    {
        $user = Auth::user();

        $id = '';
        $inKodeLevel1 = '';
        $level = 1;
        $namaCoa = $request->input('level');
        $keterangan = '';
        $idUser = $user->id;

        $resultsCoa = DB::select('CALL 9_MASTER_COA_GET_DATA_BYLEVEL(?, ?)', [$level, $idUser]);

        $dropdownOptionsCoa = $resultsCoa;
        foreach ($resultsCoa as $result) {
            if ($result->LEVEL === '1'){
                // Assuming you have a property named NAMA_COA in the results
            $dropdownOptionsCoa[] = $result->NAMA_COA;
            }
            
        }



        // Call the stored procedure using the select method
        $result = DB::select('CALL 9_MASTER_COA_INS_NEW(?, ?, ?, ?, ?, ?)', [
            $id, $inKodeLevel1, $level, $namaCoa, $keterangan, $idUser
        ]);

        // Return a response indicating success (optional)
        return view('coa', ['user' => $user, 'dropdownOptionsCoa' => $dropdownOptionsCoa]);
    }
}
