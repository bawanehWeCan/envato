<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;
use Redirect;
use URL;
use Session;




class SocialController extends Controller
{
    
    public function redirect($provider,Request $request)
    {   

        return Socialite::driver($provider)->redirect();
    }


    public function Callback(){
        $userSocial =   Socialite::driver('facebook')->stateless()->user();
        $users       =   User::where(['email' => $userSocial->getEmail()])->first();

        if($users){
            Auth::login($users);

            //print_r(Session::get('redirect'));
            if(Session::get('redirect') == 'new'){
                return redirect('/u/'.$users->username);
            }else{
                
                return redirect(Session::get('redirect'));
            }
            


        }else{
            $user = User::create([
                'name'          => $userSocial->getName(),
                'username'      => $userSocial->getId(),
                'email'         => $userSocial->getEmail(),
                'image'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => 'facebook',
            ]);

            Auth::login($user);
            
            if(Session::get('redirect') == 'new'){
                return redirect('/u/'.$user->username);
            }else{
                
                return redirect(Session::get('redirect'));
            }


        }
}
public function TwitterCallback()
{
         $twitterSocial =   Socialite::driver('twitter')->user();
        $users       =   User::where(['email' => $twitterSocial->getEmail()])->first();
if($users){
            Auth::login($users);
            if(Session::get('redirect') == 'new'){
                return redirect('/u/'.$users->username);
            }else{
                
                return redirect(Session::get('redirect'));
            }
        }else{
$user = User::firstOrCreate([
                'name'          => $twitterSocial->getName(),
                'email'         => $twitterSocial->getEmail(),
                'username'      => $twitterSocial->getId(),
                'image'         => $twitterSocial->getAvatar(),
                'provider_id'   => $twitterSocial->getId(),
                'provider'      => 'twitter',
            ]);
            Auth::login($user);
            if(Session::get('redirect') == 'new'){
                return redirect('/u/'.$user->username);
            }else{
                
                return redirect(Session::get('redirect'));
            }
        }
  }
}
