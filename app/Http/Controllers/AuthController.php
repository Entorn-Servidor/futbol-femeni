<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str; 

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Error autenticant amb Google.']);
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            if ($user->role !== 'convidat') {
                return redirect('/login')->withErrors(['error' => 'Els usuaris registrats han d\'usar contrassenya.']);
            }

            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);
        } else {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'role' => 'convidat', 
                'password' => bcrypt(Str::random(24)), 
            ]);
        }

        Auth::login($user);
        return redirect('/dashboard'); 
    }
}