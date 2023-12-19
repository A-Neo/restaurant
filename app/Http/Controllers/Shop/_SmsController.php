<?php

namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\SmsRequest;
use App\Models\Phone;
use App\Models\User;
use App\Service\SmsService;
use App\Http\Responses\SmsResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class _SmsController extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendPhone(Request $request)
    {
        $phone = $request->input('phone');
        $user = User::firstOrCreate(['phone' => $phone]);

        try {
            if (!$user->is_confirmed) {
                $array = $this->smsService->sendSms($user->phone);
                $user->name = 'user_' . rand(3, 10);
                $user->confirmation_code = $array['code']; // Код по умолчанию
                $user->save();
                return $array['code'];
            }

        } catch (\Exception $e) {
            return SmsResponse::failure();
        }

        // Отправка SMS опущена для демонстрации
        // return response()->json(['message' => 'SMS sent successfully', 'user' => Auth::user()]);
    }

    public function verifyCode(Request $request)
    {
        $user = User::findOrFail(Auth::user()->getAuthIdentifier());
// Авторизация пользователя
        Auth::login($user);
        if ($user->confirmation_code === $request->input('code')) {
            $user->is_confirmed = true;
            $user->save();
            return true;
        }
        return false;
    }
}
