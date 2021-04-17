<?php
namespace App\Helper;

class Responser
{
    private function send($status, $message, $data, $code)
    {
        return response()->json(compact('status', 'message', 'data'), $code);
    }

    public static function success($message='', $data=[], $code=200)
    {
        return (new self)->send(true, $message, $data, $code);
    }
    public static function failed($message='', $data=[], $code=200)
    {
        return (new self)->send(false, $message, $data, $code);
    }
}
