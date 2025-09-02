<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
use App\Traits\SmsOtpTrait;

class AuthController extends Controller
{
    use SmsOtpTrait;
    public function requestOtp(Request $request)
    {
        $request->validate([
            'ph_number' => 'required|regex:/^[0-9]{10}$/'
        ], [
            'ph_number.regex' => 'Invalid phone number'
        ]);

        $phone = $request->input('ph_number');
        $otp   = rand(1000, 9999);

        $user = User::where('phone', $phone)->where('role_id', 3)->first();

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'User not found. Please register first.',
            ], 404);
        }

        $user->update([
            'otp'        => $otp,
            'created_at' => now(),
        ]);

        $recipients  = "91" . trim($phone);
        $app_name    = "Salon Unitii -- salon";
        $messagetext = "Your OTP for $app_name is " . $otp . ". Please do not share this OTP.";
        $template_id = "1407168862906996721";

        $this->sendSmsCommon($recipients, $messagetext, $template_id);

        DB::table('settings')->where('variable', 'total_otp_used')->increment('value');

        return response()->json([
            'status'  => true,
            'message' => 'OTP sent successfully',
            'phone' => $request->ph_number
        ]);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'ph_number' => 'required|regex:/^[0-9]{10}$/',
            'otp'       => 'required|digits:4'
        ]);

        $user = User::where('phone', $request->ph_number)
            ->where('otp', $request->otp)
            ->where('role_id', 3)
            ->first();

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid OTP. Please try again.'
            ], 401);
        }

        $user->update(['otp' => null]);

        $token = $user->createToken('salonMobileToken')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'OTP verified successfully!',
            'token'   => $token,
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'phone' => $user->phone,
                'role'  => 'customer'
            ]
        ]);
    }
}
