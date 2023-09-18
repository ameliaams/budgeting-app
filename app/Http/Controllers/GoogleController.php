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
  
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $findUser = User::where('email', $user->getEmail())->first();

            if($findUser != null){
                Auth::login($findUser, true);
            }else{
                $create = User::Create([
                    'username' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => bcrypt('12345678') 
                ]);
        
                
                Auth::login($create);
            }
            return redirect()->intended('home');
    }
}
