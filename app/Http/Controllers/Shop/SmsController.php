<?php

namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\SmsRequest;
use App\Models\Phone;
use App\Models\User;
use App\Service\SmsService;
use App\Http\Responses\SmsResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsController extends Controller
{
    public function index(Request $request)
    {
        $order = array('(', ')', '-', ' ');
        $phone = str_replace($order,'', $request->input('phone'));

        $user = User::firstOrCreate(['phone' => $phone]);

        $login = 'dedi';
        $password = 'GcD3CGFm.8@RR7x';
        $link = "https://smsc.ru/sys/send.php?login=" . $login . "&psw=" . $password . "&phones=" . $phone . "&mes=code&call=1";
        //$http = Http::get($link);
        //$code = substr($http->body(), -4);
        $code = '1111';
        $user->confirmation_code = $code; // Код по умолчанию
        if ($user->name == null) { $user->name = 'user_' . rand(3, 1000); }
        $user->save();

        session(['phone' => $phone]);
        session(['code' => $code]);

        return $code;
    }

    public function code(Request $request)
    {
        $user = User::firstOrCreate(['phone' => session('phone')]);
        $code = $request->input('code');
        if ($code == $user->confirmation_code) {
            $user->is_confirmed = true;
            $user->save();
            Auth::login($user);
            return $user->phone;
        } else {
            return false;
        }

    }
}
