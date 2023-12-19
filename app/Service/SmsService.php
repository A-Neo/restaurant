<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class SmsService
{
    protected $apiUrl;
    protected $login;
    protected $password;

    public function __construct()
    {
        $this->apiUrl = config('sms.api_url');
        $this->login = config('sms.login');
        $this->password = config('sms.password');
    }

    public function sendSms($phone)
    {
        $response = Http::get($this->apiUrl, [
            'login' => $this->login,
            'psw' => $this->password,
            'phones' => $phone,
            'mes' => 'code',
            'call' => 1,
            'charset' => 'utf-8',
            'fmt' => 3 // JSON format
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception('Failed to send SMS.');
        }
    }

    /**
     * Проверяет валидность SMS кода.
     *
     * @param string $code
     * @param string $phone
     * @return bool
     */
    public function verifyCode($code, $phone)
    {
        // Получаем сохраненный код из кеша
        $cachedCode = Cache::get($this->getCacheKey($phone));
        return $cachedCode === $code;
    }

    /**
     * Генерирует уникальный ключ для кеширования.
     *
     * @param string $phone
     * @return string
     */
    protected function getCacheKey($phone)
    {
        return 'sms_code_for_' . $phone;
    }

    /**
     * Сохраняет код в кеш.
     *
     * @param string $phone
     * @param string $code
     * @return void
     */
    public function cacheCode($phone, $code)
    {
        Cache::put($this->getCacheKey($phone), $code, now()->addMinutes(10)); // Код действителен 10 минут
    }
}
