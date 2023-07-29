<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class laporanTransaksiMasukController extends Controller
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
            $results = DB::select('CALL 9_TRANSAKSI_KAS_MASUK_GET_DATA_BYTANGGAL(?, ?, ?)', [
                $IN_TANGGAL_AWAL,
                $IN_TANGGAL_AKHIR,
                $IN_ID_USER,
            ]);
            
            // Lakukan apapun yang Anda perlukan dengan hasil data
            // Misalnya, tampilkan data menggunakan view
            return view('laporanTransaksiMasuk', [
                'user' => $user,
                'results' => $results,
            ]);
    }
    public function deleteData(Request $request, $id)
{
    $user = Auth::user();
    $IN_TANGGAL_AWAL = $request->input('tanggalA');
    $IN_TANGGAL_AKHIR = $request->input('tanggalAK');
    $idUser = $user->id;

    // Call the stored procedure using the statement method
    $delete = DB::statement('CALL 9_KAS_DEL_BYID(?)', [$id]);

    // Check the result and handle any success or error conditions
    if ($delete) {
        // Delete successful
        // Now call the stored procedure to get the year value
        $tahunAjaranResult = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$idUser]);
        // Assuming the stored procedure returns a single row with a 'tahun_ajaran' column
        $idTahunAjaran = $tahunAjaranResult[0]->ID;

        // Now call the stored procedure to update data in 9_master_rab table
        $update = DB::statement("CALL 9_KAS_UPDATE_MASTER_RAB(?, ?, ?)", [$id, $idTahunAjaran, $idUser]);

        // After the update, retrieve the data based on the input dates
        $results = DB::select('CALL 9_TRANSAKSI_KAS_MASUK_GET_DATA_BYTANGGAL(?, ?, ?)', [
            $IN_TANGGAL_AWAL,
            $IN_TANGGAL_AKHIR,
            $idUser,
        ]);

        // Return the view with the updated data and input dates
        return view('laporanTransaksiMasuk', [
            'user' => $user,
            'results' => $results,
            'tgl_awal' => $IN_TANGGAL_AWAL,
            'tgl_akhir' => $IN_TANGGAL_AKHIR,
        ]);
    } else {
        // Delete failed
        return redirect()->route('laporanTransaksiMasuk')->with('error', 'Failed to delete data.');
    }
}
}
