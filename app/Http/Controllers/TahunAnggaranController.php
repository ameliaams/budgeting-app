<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TahunAnggaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $user = Auth::user();

        $idUser = 25;
        // Call the stored procedure and fetch the data
        $tahun = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$idUser]);

        return view('tahun', ['user' => $user, 'tahun' => $tahun]);
    }
}
