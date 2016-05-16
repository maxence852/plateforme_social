<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
class SocialAuthController extends Controller
{
    /****************Facebook***********************/

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect()->to('gestion');
    }

    /****************Google***********************/

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser2(Socialite::driver('google')->user());

        auth()->login($user);

        return redirect()->to('gestion');
    }


    /****************Twitter***********************/
    
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser3(Socialite::driver('twitter')->user());

        auth()->login($user);

        return redirect()->to('gestion');
    }
}
