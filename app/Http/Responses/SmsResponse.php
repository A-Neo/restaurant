<?php

namespace App\Http\Responses;

class SmsResponse
{
    public static function success()
    {
        return response()->json(['message' => 'SMS sent successfully'], 200);
    }

    public static function failure()
    {
        return response()->json(['message' => 'SMS sending failed'], 500);
    }
}
