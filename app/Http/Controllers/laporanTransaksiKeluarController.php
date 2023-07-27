<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class laporanTransaksiKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
            $IN_TANGGAL_AWAL = $request->input('tanggalA'); // Ganti dengan tanggal awal yang sesuai
            $IN_TANGGAL_AKHIR = $request->input('tanggalAK'); // Ganti dengan tanggal akhir yang sesuai
            $IN_ID_USER = auth()->user()->id; // Ganti dengan ID user yang sesuai

            // Panggil stored procedure menggunakan Query Builder
            $results = DB::select('CALL 9_TRANSAKSI_KAS_GET_DATA_BYTANGGAL(?, ?, ?)', [
                $IN_TANGGAL_AWAL,
                $IN_TANGGAL_AKHIR,
                $IN_ID_USER,
            ]);
            
            // Lakukan apapun yang Anda perlukan dengan hasil data
            // Misalnya, tampilkan data menggunakan view
            return view('laporanTransaksiKeluar', ['user' => $user, 'results' => $results]);

    }
}
