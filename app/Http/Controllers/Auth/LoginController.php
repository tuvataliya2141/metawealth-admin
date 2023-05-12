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
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;

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
        if($role == 1) {
            return route('adminDashboard');
        } else {
            $otp = rand(1231,7879);
            $user = User::findorFail(auth()->user()->id);
            $details =[
                'user' => [
                    'user_id' => encrypt(auth()->user()->id),
                    'email' => auth()->user()->email,
                    'img' => env('LOGO'),
                    'otp' => $otp,
                ],
                'view' => 'mails.otpVerification'
            ];
            // dd($details);
            $result = (new MailController)->send($details);
            if($result){
                if($user) {
                    $user->otp = $otp;
                    if($user->update()) {
                        return route('verifyOtpByLogin', encrypt($user->id));
                    }
                } 
            } else {
                return route('verifyOtpByLogin', encrypt($user->id));
            }
        }
        
    }


    public function verifyOtpByLogin($id) {
        $id= decrypt($id);
        $user = User::findorFail($id);
        return view('auth.otp_verify', compact('user'));
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

    public function otpCheck(Request $request) {
        // dd($request->all());
        $user = User::find($request->id);
        if($user) {
            $role = $user->role;
            if($user->otp == $request->otp){
                $user->otp_verified = 1;
                if($user->update()) {                
                    if($role == 0) { //role:- user
                        $dashRoute = 'dashboard';
                    } else if($role == 2) {//role:- superadmin
                        $dashRoute = 'subAdminDashboard';
                    } else if($role == 3) {//role:- advisor
                        $dashRoute = 'advisorDashboard';
                    }
                    return redirect()->route($dashRoute);
                }
            } else {
                return redirect()->route('verifyOtpByLogin', encrypt($user->id))->with('error', 'Your otp is wrong, Please try again.');
            } 
        } else {
            return redirect()->route('login')->with('error', 'User not found, Please try again.');
        }
    }

    public function otpResendEmail(Request $request) {
        $otp = rand(1231,7879);
        $details =[
            'user' => [
                'user_id' => encrypt($request->id),
                'email' => $request->email,
                'img' => env('LOGO'),
                'otp' => $otp,
            ],
            'view' => 'mails.otpVerification'
        ];
        $user = [
            'id' => $request->id,
            'email' => $request->email,
        ];

        $result = (new MailController)->send($details);

        return redirect()->route('verifyOtpByLogin', encrypt($request->id));
    }

    public function resetPassword(Request $request) {
        $user = User::where('email', $request->email)->first();

        if($user) {
            $otp = random_int('100000', '999999');
            $user->otp = $otp;
            $user->update();
            $details =[
                'user' => [
                    'email' => $user->email,
                    'otp' => $otp,
                    'img' => env('LOGO'),
                ],
                'view' => 'mails.sendOtp'
            ];

            $result = (new MailController)->send($details);

            if($result) {
                $data = [
                    'success' => true,
                    'message'=> 'Email send successfully!'
                ];
                return response()->json($data);
            }

        } else {
            $data = [
                'success' => false,
                'message'=> 'User not found!'
            ];                  
            return response()->json($data);
        }
    }

    public function verifyOtp(Request $request) {
        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();

        if($user) {
            $data = [
                'success' => true,
                'message'=> 'Please enter the new password!'
            ];
            return response()->json($data);
        } else {
            $data = [
                'success' => false,
                'message'=> 'Please enter the correct OTP!'
            ];                  
            return response()->json($data);
        }
    }

    public function createNewPassword(Request $request) {
        $user = User::where('email', $request->email)->first();

        if($user) {
            $user->password = Hash::make($request->password);
            $user->update();

            $data = [
                'success' => true,
                'message'=> 'Password updated successfully!'
            ];
            return response()->json($data);
        } else {
            $data = [
                'success' => false,
                'message'=> 'User not found!'
            ];                  
            return response()->json($data);
        }
    }
}
