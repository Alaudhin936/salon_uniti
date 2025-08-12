<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
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
        $otp = rand(1000, 9999);
        $user = Salon::where('phone', $phone)->first();
        FacadesSession::put('salondummyphone', $phone);
        if ($user) {
            $user->update([
                'otp'        => $otp,
                'created_at' => now(),
            ]);

            $recipients = "91" . trim($phone);
            $app_name   = "Salon Unitii -- salon";
            $messagetext = "Your OTP for $app_name is " . $otp . ". Please do not share this OTP.";
            $template_id = "1407168862906996721";

            $this->sendSmsCommon($recipients, $messagetext, $template_id);

            DB::table('settings')
                ->where('variable', 'total_otp_used')
                ->increment('value');
            return redirect()->route('verifyOTP')->with('success', 'OTP sent successfully');
        } else {
            return back()->with('error', 'Invalid phone number');
        }
    }

    public function sendSmsCommon($recipients, $messagetext, $template_id)
    {
        $apiKey = '76a4a331953994b26514dbee1a9b275c';
        $sender = 'INSTNE';
        $route = 2;
        $messagetext = urlencode($messagetext);

        $url = "http://sms.spiderindia.com/api/smsapi?key={$apiKey}&route={$route}&sender={$sender}&number={$recipients}&templateid={$template_id}&sms={$messagetext}";

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            \Log::error('SMS sending failed: ' . curl_error($curl));
            curl_close($curl);
            return false;
        }

        curl_close($curl);
        return $response;
    }

    public function salonVerifyOTP(Request $request)
    {
        $submittedOtp = $request->input('verify_otp');
        $phone = session('salondummyphone');
        $user = Salon::where('phone', $phone)
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

            return redirect()->route('vendor_dashboard')
                ->with('message', 'OTP verified successfully!');
        } else {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
    }
}
