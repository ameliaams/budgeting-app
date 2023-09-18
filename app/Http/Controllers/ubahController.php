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

    public function index()
    {
        return view('ubah');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $oldPasswordInput = $request->input('passwordLama');
    
        // Check if the provided old password matches the stored hashed password
        if (Hash::check($oldPasswordInput, $user->password)) {
            $newPassword = $request->input('passwordBaru');

            DB::select('CALL UBAH_PASSWORD(?, ?, ?, ?)', [
                $user->id,
                $user->username,
                $newPassword,
                $oldPasswordInput,
            ]);
    
            return redirect()->route('ubah.index')->with('success', 'Password changed successfully');
        } else {
            return redirect()->route('ubah.index')->with('error', 'Old password is incorrect');
        }
    }
}

