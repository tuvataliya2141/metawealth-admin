<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\PersonalDetails;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function registration(Request $request) {
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $details =[
            'user' => [
                'user_id' => encrypt($user->id),
                'email' => $user->email,
                'img' => env('LOGO'),
            ],
            'view' => 'mails.verifyAccount'
        ];

        $result = (new MailController)->send($details);

        if($result) {
            $personalDetails = PersonalDetails::create([
                'user_id' => $user->id,
                'first_name' => encrypt($request->first_name),
                'last_name' => encrypt($request->last_name),
                'phone' => encrypt($request->phone),
                'email' => encrypt($request->email),
                'dob' => encrypt($request->dob),
                'gender' => encrypt($request->gender),
                'marital_status' => encrypt($request->marital_status),
                'retired' => encrypt($request->retired),
                'joint_plan' => encrypt($request->joint_profile),
                'status' => encrypt('self'),
            ]);

            if($personalDetails) {
                return redirect()->route('verifyEmail')->with('user', $user);
            }

        } else {
            $user = User::findorFail($user->id);
            $user->delete();
            return redirect()->route('register')->with('error', 'Entered Email is not correct please try again.');
        }
    }

    public function verifyEmail() {
        if(auth()->user()) {
            $users = auth()->user();
        } else {
            $users = session('user');
        }

        $user = [
            'id' => isset($users->id) ? $users->id : $users['id'],
            'email' => isset($users->email) ? $users->email : $users['email'],
        ];

        return view('auth.verify', compact('user'));
    }

    public function verification($email) {
        $userId = decrypt($email);
        $current_date_time = Carbon::now()->toDateTimeString();

        $user = User::findorFail($userId);
        if($user) {
            $user->email_verified_at = $current_date_time;
            if($user->update()) {
                return redirect()->route('login')->with('success', 'Verification success, please login again to use our servies.');
            }
        } else {
            return redirect()->route('login')->with('error', 'User not found, please check the email id and password to make sure you entered correctly.');
        }
    }

    public function resendEmail(Request $request) {
        $details =[
            'user' => [
                'user_id' => encrypt($request->id),
                'email' => $request->email,
                'img' => env('LOGO'),
            ],
            'view' => 'mails.verifyAccount'
        ];

        $user = [
            'id' => $request->id,
            'email' => $request->email,
        ];

        $result = (new MailController)->send($details);

        return redirect()->back()->with('user', $user);
    }
}
