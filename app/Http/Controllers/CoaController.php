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
        $level = 1;
        $inSearch = '%%';
        $idUser = $user->id;

        // Call the stored procedure and fetch the data
        $data = DB::select('CALL 9_MASTER_COA_GET_DATA(?, ?)', [$inSearch, $idUser]);
        $resultsCoa = DB::select('CALL 9_MASTER_COA_GET_DATA_BYLEVEL(?, ?)', [$level, $idUser]);

        $dropdownOptionsCoa = [];
        foreach ($resultsCoa as $result) {
        $dropdownOptionsCoa[] = $result;
    }

    return view('coa', [
        'user' => $user,
        'data' => $data, // Assuming $result contains the newly added data, otherwise, adjust accordingly.
        'dropdownOptionsCoa' => $dropdownOptionsCoa
    ]);
    }

    public function addData(Request $request)
    {
        $user = Auth::user();

        $id = '';
        $inKodeLevel1 = $request->input('level');
        $level = 2;
        $namaCoa = $request->input('nama_akun');
        $keterangan = '';
        $idUser = $user->id;

        // Call the stored procedure using the select method
        $result = DB::statement('CALL 9_MASTER_COA_INS_NEW(?, ?, ?, ?, ?, ?)', [
            $id, $inKodeLevel1, $level, $namaCoa, $keterangan, $idUser
        ]);

        // echo dd($result);

        // Pass the user, updated dropdown options, and the newly added data to the view
        return redirect()->route('coa.index')->with('success', 'Data Berhasil Disimpan!');
    }

    public function deleteData($id)
    {
        $user = Auth::user();

    // Call the stored procedure using the select method
    $result = DB::statement('CALL 9_MASTER_COA_DEL_BYID(?)', [$id]);

    // Check the result and handle any success or error conditions
    if ($result) {
        // Delete successful
        return redirect()->route('coa.index')->with('success', 'Data Berhasil Dihapus!');
    } else {
        // Delete failed
        return redirect()->route('coa.index')->with('error', 'Failed to delete data.');
    }
    }
}
