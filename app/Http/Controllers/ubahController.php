<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        $newPassword = $request->input('new_password');

        // Call the stored procedure using the DB facade
        $result = DB::select('CALL Ubah_Password(?, ?, ?)', [
            $id_user,
            $username,
            $newPassword
        ]);

        // The $result variable contains the result from the stored procedure
        // You can check the result and take appropriate actions

        return view('ubah', ['user' => $user]);
    }
}

