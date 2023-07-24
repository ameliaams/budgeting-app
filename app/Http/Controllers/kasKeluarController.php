<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class kasKeluarController extends Controller
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

        $IN_SEARCH = '%%'; // Replace 'your_search_string' with the actual search string
        //$NAMA_COA = ''; // Replace 'your_nama_coa_value' with the actual value
        $IN_SALDO_NORMAL = 'K'; // Assuming the value does not exceed 5 characters
        $IN_ID_USER = 11; // Assuming the value does not exceed 5 characters
        
        // Call the stored procedure using DB::select
        $results = DB::select('CALL 9_MASTER_COA_GET_DATA_BY_SALDO_NORMAL(?, ?, ?)', [$IN_SEARCH, $IN_SALDO_NORMAL, $IN_ID_USER]);

        $dropdownOptions = [];
        foreach ($results as $result) {
        if ($result->SALDO_NORMAL === 'K') {
            $dropdownOptions[] = $result->NAMA_COA;
        }
    }

        // Pass the $results variable to the view
       
        return view('kasKeluar', [
            'user' => $user,
            'dropdownOptions' => $dropdownOptions,
        ]);;
    }

}


