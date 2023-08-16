<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class kasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $idUser = $user->id;
        $data = DB::select('CALL 9_MASTER_KAS_GET_DATA(?)', [$idUser]);

        return view('kas', ['user' => $user, 'data' => $data]);
    }

    public function addData(Request $request)
    {
        $user = Auth::user();

        $id = '';
        $kode = $request->input('kode');
        $namaKas = $request->input('nama_kas');
        $keterangan = $request->input('keterangan');
        $idUser = $user->id;

        // Call the stored procedure
        $result = DB::statement('CALL 9_MASTER_KAS_INS(?, ?, ?, ?, ?)', [
            $id, $kode, $namaKas, $keterangan, $idUser
        ]);

        return redirect()->route('kas.index')->with('success', 'Data Berhasil Disimpan!');
    }

    public function deleteData($id)
    {
        $user = Auth::user();
        // Call the stored procedure
        $result = DB::statement('CALL 9_MASTER_KAS_DEL_BYID(?)', [$id]);

        // Check the result
        if ($result) {
            return redirect()->route('kas.index')->with('success', 'Data Berhasil Dihapus!');
        } else {
            return redirect()->route('kas.index')->with('error', 'Failed to delete data.');
        }
    }
    public function editData(Request $request, $id)
    {
        $kode = $request->input('kode');
        $namaKas = $request->input('nama_kas');
        $keterangan = $request->input('keterangan');
        $idUser = auth()->user()->id;

        $resultsCoa = DB::select('CALL 9_MASTER_KAS_GET_DATA(?)', [$idUser]);

        // Call the stored procedure using the DB::select() method
        $result = DB::statement('CALL 9_MASTER_KAS_INS(?, ?, ?, ?, ?)', [
            $id, $kode, $namaKas, $keterangan, $idUser
        ]);

        if ($result) {
            return redirect()->route('kas.index')->with('success', 'Data Berhasil Disimpan!');
        } else {
            // Operation failed or record with the given ID not found
            return redirect()->route('kas.index')->with('error', 'Failed to update data.');
        }
    }
}
