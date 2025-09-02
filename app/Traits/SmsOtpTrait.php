<?php

namespace App\Traits;

trait SmsOtpTrait
{
    public function sendSmsCommon($recipients, $messagetext, $template_id)
    {

        $apiKey = env('SMS_API_KEY');
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
}
