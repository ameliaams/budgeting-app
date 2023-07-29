<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction; 

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
            $results = DB::select('CALL 9_TRANSAKSI_KAS_KELUAR_GET_DATA_BYTANGGAL(?, ?, ?)', [
                $IN_TANGGAL_AWAL,
                $IN_TANGGAL_AKHIR,
                $IN_ID_USER,
            ]);
            // Call the second stored procedure using DB::select (KAS GET DATA)
        $resultsKas = DB::select('CALL 9_master_kas_get_data()');

        $dropdownOptionsKas = [];
        foreach ($resultsKas as $result) {
        // Assuming you have a property named NAMA_KAS in the results
        $dropdownOptionsKas[] = $result;
    }
        // Pass the $results variable to the view
            // Lakukan apapun yang Anda perlukan dengan hasil data
            // Misalnya, tampilkan data menggunakan view
            return view('laporanTransaksiKeluar', [
                'user' => $user,
                'results' => $results,
                'dropdownOptionsKas' => $dropdownOptionsKas,
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
        $results = DB::select('CALL 9_TRANSAKSI_KAS_KELUAR_GET_DATA_BYTANGGAL(?, ?, ?)', [
            $IN_TANGGAL_AWAL,
            $IN_TANGGAL_AKHIR,
            $idUser,
        ]);

        // Return the view with the updated data and input dates
        return view('laporanTransaksiKeluar', [
            'user' => $user,
            'results' => $results,
            'tgl_awal' => $IN_TANGGAL_AWAL,
            'tgl_akhir' => $IN_TANGGAL_AKHIR,
        ]);
    } else {
        // Delete failed
        return redirect()->route('laporanTransaksiKeluar')->with('error', 'Failed to delete data.');
    }
}

public function editData(Request $request, $id)
{
    $IN_TANGGAL = $request->validate(['tanggal' => 'required|date']);
    $IN_ID_COA = $request->input('kredit');
    $IN_ID_KAS = $request->input('kas');
    $IN_JENIS_TRANSAKSI = 'K'; // Assuming this is a constant value
    $IN_KETERANGAN = $request->input('keterangan');
    $IN_NO_REF = $request->input('no_ref');
    $IN_NOMINAL = $request->validate(['nominal' => 'required|numeric']);
    $IN_ID = ''; // IN_ID will be empty for new records (insert)
    $IN_KODE_KWINTANSI = $this->getKodeKwitansi($request);
    $IN_DEPARTEMEN = ''; // Assuming this is not used for the insert operation
    $IN_PENANGGUNG_JAWAB = ''; // Assuming this is not used for the insert operation
    $IN_VERIFIKASI = '1'; // Assuming this is not used for the insert operation
    $IN_ID_TAHUN_AJARAN = $this->getTahunAjaranAktif();// Assuming this is not used for the insert operation
    $IN_KODE_PENARIKAN_DANA = ''; // Assuming this is not used for the insert operation
    $IN_NOMINAL_PERUBAHAN = $request->input('IN_NOMINAL_PERUBAHAN'); // Assuming this is not used for the insert operation
    $IN_ID_USER = auth()->user()->id;
    
    $request->validate([
        'nominal' => 'required|numeric',
        'tanggal' => 'required|date',
    ]);
    
    $results = DB::select("CALL GET_KODE_KWITANSI(?, ?, ?)",
    [$IN_JENIS_TRANSAKSI, $IN_TANGGAL, $IN_ID_USER]);

    $results = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$IN_ID_USER]);

    if (empty($IN_NOMINAL_PERUBAHAN)) {
        $IN_NOMINAL_PERUBAHAN = 0; // or $IN_NOMINAL_PERUBAHAN = null;
    }
    // Call the store procedure using DB::select
    $results = DB::statement('CALL 9_TRANSAKSI_KAS_INS(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
        $IN_ID,
        $IN_KODE_KWINTANSI,
        $IN_TANGGAL,
        $IN_ID_COA,
        $IN_ID_KAS,
        $IN_JENIS_TRANSAKSI,
        $IN_KETERANGAN,
        $IN_DEPARTEMEN,
        $IN_PENANGGUNG_JAWAB,
        $IN_NOMINAL,
        $IN_VERIFIKASI,
        $IN_NO_REF,
        $IN_ID_TAHUN_AJARAN,
        $IN_KODE_PENARIKAN_DANA,
        $IN_NOMINAL_PERUBAHAN,
        $IN_ID_USER,
    ]);
    // Check the result and handle any success or error conditions
    if ($result) {
        // Update successful
        return redirect()->route('laporanTransaksiKeluar.edit')->with('success', 'Data has been updated successfully!');
    } else {
        // Update failed
        return redirect()->route('laporanTransaksiKeluar.edit')->with('error', 'Failed to update data.');
    }
}   

public function getKodeKwitansi(Request $request)
{
    $IN_JENIS_TRANSAKSI = 'K'; // Set the value for IN_JENIS_TRANSAKSI (example: 'M' or 'K')
    $IN_TANGGAL = $request->input('tanggal'); // Set the value for IN_TANGGAL (example: 'YYYY-MM-DD')
    $IN_ID_USER = auth()->user()->id; // Set the value for IN_ID_USER (example: '25' or any valid user ID)

    try {
        // Call the stored procedure using DB facade
        $results = DB::select("CALL GET_KODE_KWITANSI(?, ?, ?)",
        // call kode kwitansi
        [$IN_JENIS_TRANSAKSI, str_replace('-', '', $IN_TANGGAL), $IN_ID_USER]);


        // $results will contain the result of the stored procedure call
        // The result will be an array of rows, but in this case, it will have only one row
        // You can access the KODE_KWITANSI value as follows:
        $kodeKwitansi = $results[0]->KODE_KWITANSI;

        // Now you can use $kodeKwitansi as needed
        return $kodeKwitansi;
    } catch (\Exception $e) {
        // Handle the exception if the stored procedure call fails
        return null; // or throw an exception if you want to handle the error differently
    }
}

public function getTahunAjaranAktif()
{
    $userId = auth()->user()->id; // Get the current user ID or replace it with the user ID you want to use

    try {
        // Call the stored procedure using DB::select
        $results = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$userId]);

        // $results will contain the result of the stored procedure call
        // The result will be an array of rows, but in this case, it will have only one row as you are using LIMIT 0,1 in the stored procedure
        // You can access the values from the result as needed
        // For example, to get the ID, you can do the following:
        $tahunAjaranAktifId = $results[0]->ID;

        // Now you can use $tahunAjaranAktifId or any other values as needed
        return $tahunAjaranAktifId;
    } catch (\Exception $e) {
        // Handle the exception if the stored procedure call fails
        return null; // or throw an exception if you want to handle the error differently
    }
}
}
