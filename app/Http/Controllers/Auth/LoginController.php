<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\PersonalDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo() {
        $role = auth()->user()->role;

        if($role == 0) { //role:- user
            $dashRoute = 'dashboard';
        } else if($role == 1) {//role:- admin
            $dashRoute = 'adminDashboard';
        } else if($role == 2) {//role:- superadmin
            $dashRoute = 'subAdminDashboard';
        } else if($role == 3) {//role:- advisor
            $dashRoute = 'advisorDashboard';
        }

        return route($dashRoute);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {        
        $user = Socialite::driver('google')->user();
        $existingUser = User::where('email', $user->email)->first();
        
        $current_date_time = Carbon::now()->toDateTimeString();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $password = $user->given_name . '@123';
            $newUser = User::create([
                'name' => $user->name,
                'role' => 0,
                'email' => $user->email,
                'email_verified_at' => ($user->user['email_verified'] == true) ? $current_date_time : null,
                'password' => Hash::make($password),
            ]);

            if($newUser) {
                $personalDetails = PersonalDetails::create([
                    'user_id' => $newUser->id,
                    'first_name' => encrypt($user->user['given_name']),
                    'last_name' => encrypt($user->user['family_name']),
                    'email' => encrypt($user->email),
                    'status' => encrypt('self'),
                ]);
    
                if($personalDetails) {
                    auth()->login($newUser, true);
                    return redirect()->route('dashboard')->with('user', $newUser);
                }
            }
        }
    }
}
