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
        $user = Auth::user();
        $oldPassword = $request->input('passwordLama');
        $newPassword = $request->input('passwordBaru');
    
        $tableExists = DB::table('information_schema.tables')
                ->where('table_schema', '=', 'budgeting_db')
                ->where('table_name', '=', 'Users')
                ->exists();

        if ($tableExists) {
            // Call the stored procedure
            DB::statement("CALL Ubah_Password('$username', '$oldPassword', '$newPassword')");
        } else {
            // Handle the absence of the table
        }

        return view('ubah', ['user' => $user]);
    }
}

