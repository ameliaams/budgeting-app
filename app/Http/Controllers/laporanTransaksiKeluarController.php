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
        $IN_TANGGAL_AWAL = $request->input('tanggalA');
        $IN_TANGGAL_AKHIR = $request->input('tanggalAK');
        $IN_ID_USER = auth()->user()->id;

        // Call Store Procedure
        $results = DB::select('CALL 9_TRANSAKSI_KAS_KELUAR_GET_DATA_BYTANGGAL(?, ?, ?)', [
            $IN_TANGGAL_AWAL,
            $IN_TANGGAL_AKHIR,
            $IN_ID_USER,
        ]);
        // Call the second stored procedure
        $resultsKas = DB::select('CALL 9_master_kas_get_data()');

        $dropdownOptionsKas = [];
        foreach ($resultsKas as $result) {
            $dropdownOptionsKas[] = $result;
        }

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

        // Call the stored procedure
        $delete = DB::statement('CALL 9_KAS_DEL_BYID(?)', [$id]);

        // Check the result and handle any success or error conditions
        if ($delete) {
            // Delete successful
            // Call the stored procedure to get the year value
            $tahunAjaranResult = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$idUser]);
            $idTahunAjaran = $tahunAjaranResult[0]->ID;

            // Update data
            $update = DB::statement("CALL 9_KAS_UPDATE_MASTER_RAB(?, ?, ?)", [$id, $idTahunAjaran, $idUser]);
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
        $IN_TANGGAL = $request->input('tanggal');
        $IN_ID_COA = $request->input('kredit');
        $IN_ID_KAS = $request->input('kas');
        $IN_JENIS_TRANSAKSI = 'K';
        $IN_KETERANGAN = $request->input('keterangan');
        $IN_NO_REF = $request->input('no_ref');
        $IN_NOMINAL = $request->input('nominal');
        $IN_KODE_KWINTANSI = $this->getKodeKwitansi($request);
        $IN_DEPARTEMEN = '';
        $IN_PENANGGUNG_JAWAB = '';
        $IN_VERIFIKASI = '1';
        $IN_ID_TAHUN_AJARAN = $this->getTahunAjaranAktif();
        $IN_KODE_PENARIKAN_DANA = '';
        $IN_NOMINAL_PERUBAHAN = $request->input('IN_NOMINAL_PERUBAHAN');
        $IN_ID_USER = auth()->user()->id;

        $request->validate([
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $results = DB::select(
            "CALL GET_KODE_KWITANSI(?, ?, ?)",
            [$IN_JENIS_TRANSAKSI, $IN_TANGGAL, $IN_ID_USER]
        );

        $results = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$IN_ID_USER]);

        if (empty($IN_NOMINAL_PERUBAHAN)) {
            $IN_NOMINAL_PERUBAHAN = 0;
        }
        // Call the store procedure
        $results = DB::statement('CALL 9_TRANSAKSI_KAS_INS(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
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
        // Check the result
        if ($results) {
            // Update successful
            $tanggalAwal = $request->input('tanggalA');
            $tanggalAkhir = $request->input('tanggalAK');
            return redirect()->route('laporanTransaksiKeluar.index', ['tanggalAwal' => $tanggalAwal, 'tanggalAkhir' => $tanggalAkhir])
                ->with('success', 'Data has been updated successfully!');
        } else {
            // Update failed
            return redirect()->route('laporanTransaksiKeluar.index')->with('error', 'Failed to update data.');
        }
    }


    public function getKodeKwitansi(Request $request)
    {
        $IN_JENIS_TRANSAKSI = 'K';
        $IN_TANGGAL = $request->input('tanggal');
        $IN_ID_USER = auth()->user()->id;

        try {
            // Call the stored procedure
            $results = DB::select(
                "CALL GET_KODE_KWITANSI(?, ?, ?)",
                [$IN_JENIS_TRANSAKSI, str_replace('-', '', $IN_TANGGAL), $IN_ID_USER]
            );
            $kodeKwitansi = $results[0]->KODE_KWITANSI;
            return $kodeKwitansi;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getTahunAjaranAktif()
    {
        $userId = auth()->user()->id;

        try {
            // Call the stored procedure
            $results = DB::select('CALL 9_MASTER_TAHUN_AJARAN_GET_TAHUN_AKTIF(?)', [$userId]);
            $tahunAjaranAktifId = $results[0]->ID;
            return $tahunAjaranAktifId;
        } catch (\Exception $e) {
            return null;
        }
    }
}
