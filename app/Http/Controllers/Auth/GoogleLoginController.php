<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleLoginController extends Controller
{
    /**
     * ユーザーをGoogleの認証ページにリダイレクトする
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * 認証後にGoogleからのコールバックを受信する
     */
    public function handleGoogleCallback()
    {
        $google_account = Socialite::driver('google')->user();

        $user = User::where('email', $google_account->getEmail())->first();

        if ($user) {

            $user->update([
                'google_id' => $google_account->getId(),
            ]);
        } else {
            
            $user = User::create([
                'email' => $google_account->getEmail(),
                'name' => $google_account->getName(),
                'google_id' => $google_account->getId(),
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user);

        return to_route('dashboard');
    }
}
