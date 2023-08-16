<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class kasMasukController extends Controller
{
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

        $IN_SEARCH = '%%';
        $IN_SALDO_NORMAL = 'd';
        $IN_ID_USER = auth()->user()->id;
        $resultsCoa = DB::select('CALL 9_MASTER_COA_GET_DATA_BY_SALDO_NORMAL(?, ?, ?)', [$IN_SEARCH, $IN_SALDO_NORMAL, $IN_ID_USER]);

        $dropdownOptionsCoa = [];
        foreach ($resultsCoa as $result) {
            if ($result->SALDO_NORMAL === 'D') {
                $dropdownOptionsCoa[] = $result;
            }
        }
        // Call the second stored procedure using DB::select (KAS GET DATA)
        $resultsKas = DB::select('CALL 9_master_kas_get_data(?)', [$IN_ID_USER]);

        $dropdownOptionsKas = [];
        foreach ($resultsKas as $result) {
            $dropdownOptionsKas[] = $result;
        }

        // Pass the $results variable to the view

        return view('kasMasuk', [
            'user' => $user,
            'dropdownOptionsCoa' => $dropdownOptionsCoa,
            'dropdownOptionsKas' => $dropdownOptionsKas,
        ]);
    }

    public function simpanData(Request $request)
    {
        $IN_TANGGAL = $request->input('tanggal');
        $IN_ID_COA = $request->input('kredit');
        $IN_ID_KAS = $request->input('kas');
        $IN_JENIS_TRANSAKSI = 'M'; // Assuming this is a constant value
        $IN_KETERANGAN = $request->input('keterangan');
        $IN_NO_REF = $request->input('no_ref');
        $IN_NOMINAL = $request->input('nominal');
        $IN_ID = ''; // IN_ID will be empty for new records (insert)
        $IN_KODE_KWINTANSI = $this->getKodeKwitansi($request);
        $IN_DEPARTEMEN = ''; // Assuming this is not used for the insert operation
        $IN_PENANGGUNG_JAWAB = ''; // Assuming this is not used for the insert operation
        $IN_VERIFIKASI = '1'; // Assuming this is not used for the insert operation
        $IN_ID_TAHUN_AJARAN = $this->getTahunAjaranAktif(); // Assuming this is not used for the insert operation
        $IN_KODE_PENARIKAN_DANA = ''; // Assuming this is not used for the insert operation
        $IN_NOMINAL_PERUBAHAN = $request->input('IN_NOMINAL_PERUBAHAN'); // Assuming this is not used for the insert operation
        $IN_ID_USER = auth()->user()->id;

        $results = DB::select(
            "CALL GET_KODE_KWITANSI(?, ?, ?)",
            [$IN_JENIS_TRANSAKSI, $IN_TANGGAL, $IN_ID_USER]
        );

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

        //session()->flash('success', 'Data berhasil disimpan.');
        // Assuming the store procedure returns a result, you can handle it here if needed.

        // Redirect back with a success message
        return redirect()->route('kasMasuk.index')->with('success', 'Data Berhasil Disimpan!');
    }

    public function getKodeKwitansi(Request $request)
    {
        $IN_JENIS_TRANSAKSI = 'M'; // Set the value for IN_JENIS_TRANSAKSI (example: 'M' or 'K')
        $IN_TANGGAL = $request->input('tanggal'); // Set the value for IN_TANGGAL (example: 'YYYY-MM-DD')
        $IN_ID_USER = auth()->user()->id; // Set the value for IN_ID_USER (example: '25' or any valid user ID)

        try {
            // Call the stored procedure using DB facade
            $results = DB::select(
                "CALL GET_KODE_KWITANSI(?, ?, ?)",
                [$IN_JENIS_TRANSAKSI, str_replace('-', '', $IN_TANGGAL), $IN_ID_USER]
            );

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

            $tahunAjaranAktifId = $results[0]->ID;

            // Now you can use $tahunAjaranAktifId or any other values as needed
            return $tahunAjaranAktifId;
        } catch (\Exception $e) {
            // Handle the exception if the stored procedure call fails
            return null; // or throw an exception if you want to handle the error differently
        }
    }

    public function someControllerMethod(Request $request)
    {
        // Get the selected value from the dropdown (replace 'kredit' with your dropdown name)
        $selectedValue = $request->input('kas');

        // Call the stored procedure and retrieve the ID based on the selected value
        $results = DB::select('CALL GET_ID(?)', [$selectedValue]);

        // Access the ID value from the result (assuming the stored procedure returns one row)
        $id = $results[0]->ID;
    }
}
