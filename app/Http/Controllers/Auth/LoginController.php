<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();

            $findUser = User::where('email', $user->email)->first();

            if ($findUser) {
                Auth::login($findUser, true);
            } else {
                $user = User::firstOrCreate([
                    'email' => $user->email,
                    'email_verified_at' => now()
                ], [
                    'name' => $user->name,
                    'password' => Hash::make(Str::random(24)),
                    'email_verified_at' => now()
                ]);
                Auth::login($user, true);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('danger', $e);
        }
        return redirect('/');
    }

    public function GoogleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function GoogleRedirectCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $findUser = User::where('email', $user->email)->first();

            if ($findUser) {
                Auth::login($findUser, true);
            } else {
                $user = User::firstOrCreate([
                    'email' => $user->email,
                    'email_verified_at' => now()
                ], [
                    'name' => $user->name,
                    'password' => Hash::make(Str::random(24)),
                    'email_verified_at' => now()
                ]);
                Auth::login($user, true);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
        return redirect('/');
    }
}
