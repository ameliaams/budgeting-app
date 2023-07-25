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

        $inSearch = '%%';
        $idUser = 11;
        // Call the stored procedure and fetch the data
        $data = DB::select('CALL 9_MASTER_COA_GET_DATA(?, ?)', [$inSearch, $idUser]);

        return view('coa', ['user' => $user, 'data' => $data]);
    }

    public function sync(Request $request)
    {
        if ($request->isMethod('post')) {
            // If the request is a POST (sync) request, update the data
    
            $id = $request->input('id');
            $nominal = $request->input('NOMINAL'); // Use 'NOMINAL' to match the JavaScript code
    
            try {
                $result = DB::update('CALL 9_MASTER_RAB_UPD(?, ?)', [
                    $id, $nominal // Assuming IN_NOMINAL_PERUBAHAN and IN_REALISASI have default values
                ]);
    
                if ($result === 1) {
                    // Update successful
    
                    // Fetch the updated data
                    $idTahunAjaran = 10;
                    $idUser = 11;
                    $data = DB::select('CALL 9_MASTER_RAB_GET_DATA(?, ?)', [$idTahunAjaran, $idUser]);
    
                    return response()->json(['success' => true, 'data' => $data]);
                } else {
                    // Update failed
                    return response()->json(['success' => false, 'message' => 'Update failed']);
                }
            } catch (\Exception $e) {
                // Handle the exception if the update fails
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            // If the request is a GET request, fetch the data for syncing
    
            $idUser = 11;
            $idTahunAjaran = 10;
            // Call the stored procedure and fetch the data
            $data = DB::select('CALL UPD_TOTAL_NOMINAL_RAB_ALL(?, ?)', [$idUser, $idTahunAjaran]);
    
            return view('rab', ['data' => $data]);
        }
    }
}
