<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ubahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $id_user = auth()->user()->id;
        $username = auth()->user()->username;
        $newPassword =   Hash::make($request->input('passwordBaru')) ;
        $oldPassword =   Hash::make($request->input('passwordLama')) ;
        // Call the stored procedure using the DB facade

        $tes = "CALL Ubah_Password(" . $id_user . ", " . $username . ", " . $newPassword . ", " . $oldPassword . ")";
        //echo dd($tes);
        $result = DB::select('CALL Ubah_Password(?, ?, ?, ?)', [
            $id_user,
            $username,
            $newPassword,
            $oldPassword
        ]);

        

        // The $result variable contains the result from the stored procedure
        // You can check the result and take appropriate actions

        return view('ubah', ['result' => $result]);
    }
}

