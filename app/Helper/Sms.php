<?php
namespace App\Helper;

use Illuminate\Support\Facades\Http;

class Sms
{
    private function triggerSMS($api)
    {
        return $api;
        $respose=file_get_contents(Http::send($api));
        Log::info($respose);
        return $respose?true:false;
    }
    private function send($number, $message)
    {
        $url='https://www.txtguru.in/imobile/api.php?';
        $username='username='.env("SMS_USERNAME");
        $password='&password='.env("SMS_PASSWORD");
        $senderId='&source=123'.env("SMS_SENDER_ID");
        $dMobile='&dmobile=91'.$number;
        $msg='&message='.$message;

        $api=$url.$username.$password.$senderId.$dMobile.$msg;
        return $this->triggerSMS($api);
    }
    public function otp($mobile_number, $otp, $hash, $type='Customer')
    {
        if (empty($mobile_number) || empty($otp)) {
            return false;
        }
        $message="<#> Dear ".$type.",\nYellowRider ".$type." login 4 digit OTP is ".$otp."\n\n".$hash;

        return $this->send($mobile_number, urlencode($message));
    }
}