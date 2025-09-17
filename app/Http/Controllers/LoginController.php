<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\SmsOtpTrait;
use Illuminate\Support\Facades\Session as FacadesSession;

class LoginController extends Controller
{
    use SmsOtpTrait;
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if (auth()->user()->role_id == 2) {
                return redirect('/salonweb/dashboard');
            } else if (auth()->user()->role_id == 1) {
                return redirect('/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function salonLoginSubmit(Request $request)
    {
        $request->validate([
            'ph_number' => 'required|regex:/^[0-9]{10}$/'
        ], [
            'ph_number.regex' => 'Invalid phone number'
        ]);

        $phone = $request->input('ph_number');
        $otp   = rand(1000, 9999);

        $user = User::where('phone', $phone)->where('role_id', 2)->first();

        if ($user) {
            session(['salondummyphone' => $phone]);

            $user->update([
                'otp'        => $otp,
                'created_at' => now(),
            ]);

            $recipients  = "91" . trim($phone);
            $app_name    = "Salon Unitii -- salon";
            $messagetext = "Your OTP for $app_name is " . $otp . ". Please do not share this OTP.";
            $template_id = "1407168862906996721";

            $this->sendSmsCommon($recipients, $messagetext, $template_id);

            DB::table('settings')
                ->where('variable', 'total_otp_used')
                ->increment('value');

            return redirect()->route('verifyOTP')->with('success', 'OTP sent successfully');
        } else {
            return back()->withErrors([
                'ph_number' => 'Phone number does not exist in our records'
            ])->withInput();
        }
    }


    public function salonVerifyOTP(Request $request)
    {
        $submittedOtp = $request->input('verify_otp');
        $phone = session('salondummyphone');

        $user = User::where('phone', $phone)
            ->where('otp', $submittedOtp)
            ->first();
        if ($user) {
            $user->update([
                'otp' => null
            ]);

            session()->forget('salondummyphone');

            session([
                'salon_logged_in' => true,
                'salon_id'        => $user->id,
                'salon_name'      => $user->name,
                'salon_phone'     => $user->phone,
                'role'            => 'salon'
            ]);
            Auth::login($user);
            return redirect()->route('vendor_dashboard')
                ->with('message', 'OTP verified successfully!');
        } else {
            return back()->withErrors([
                'verify_otp' => 'Invalid OTP. Please try again.'
            ])->withInput();
        }
    }
}
