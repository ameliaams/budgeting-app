<?php

namespace App\Http\Controllers;

use App\Models\rab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        // Call the stored procedure
        $data = DB::select('CALL 9_MASTER_RAB_GET_DATA(?, ?)', [$idTahunAjaran, $idUser]);

        return view('home', ['user' => $user, 'data' => $data]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $nominal = $request->input('NOMINAL');

        $result = DB::update('CALL 9_MASTER_RAB_UPD(?, ?, ?, ?)', [
            $id, $nominal, 0, 0
        ]);

        if ($result === 1) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
