<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

        $idTahunAjaran = 10;
        $idUser = 11;
        // Call the stored procedure and fetch the data
        $data = DB::select('CALL 9_MASTER_RAB_GET_DATA(?, ?)', [$idTahunAjaran, $idUser]);

        return view('coa', ['user' => $user, 'data' => $data]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $nominal = $request->input('NOMINAL'); // Use 'NOMINAL' to match the JavaScript code

        $result = DB::update('CALL 9_MASTER_RAB_UPD(?, ?, ?, ?)', [
            $id, $nominal, 0, 0 // Assuming IN_NOMINAL_PERUBAHAN and IN_REALISASI have default values
        ]);

        if ($result === 1) {
            // Update successful
            return response()->json(['success' => true]);
        } else {
            // Update failed
            return response()->json(['success' => false]);
        }
    }

    public function sync(Request $request){
        $idUser = 11;
        $idTahunAjaran = 10;
        $data = DB::select('CALL UPD_TOTAL_NOMINAL_RAB_ALL(?, ?)', [$idUser, $idTahunAjaran]);

        return view('coa', ['data' => $data]);
    }
}
