<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
  
    public function handleGoogleCallback(\Request $request)
    {
        $user = Socialite::driver('google')->user();
        $findUser = User::where('id', $user->getId())->first();

            if($findUser){
                Auth::login($findUser);
                return redirect()->intended('home');
            }else{
                $create = User::Create([
                    'username' => $user->getName(),
                    'password' => bycript('12345678') 
                ]);
        
                
                Auth::login($findUser);
                return redirect()->intended('home');
            }
    }
}