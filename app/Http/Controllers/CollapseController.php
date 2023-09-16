<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CollapseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $IN_TAHUN = 1;
        $IN_BULAN = 1;
        $IN_ID_KAS = 1;

        $data = DB::select('CALL LAPORAN_10_HARIAN(?, ?, ?)', [$IN_TAHUN, $IN_BULAN, $IN_ID_KAS]);

        return view('collapse', ['user' => $user, 'data' => $data]);
    }
}
