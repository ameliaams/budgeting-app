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
        $idUser = $user->id;
        // Call the stored procedure and fetch the data
        $data = DB::select('CALL 9_MASTER_COA_GET_DATA(?, ?)', [$inSearch, $idUser]);

        return view('coa', ['user' => $user, 'data' => $data]);
    }
}
