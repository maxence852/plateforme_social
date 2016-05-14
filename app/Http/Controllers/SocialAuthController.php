<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $providerUser = \Socialite::driver('facebook')->user();
    }

    public function github_redirect() {
        return Socialite::with('github')->redirect();
    }
    // to get authenticate user data
    public function github() {
        $user = Socialite::with('github')->user();
        // Do your stuff with user data.
        print_r($user);die;
    }
}
