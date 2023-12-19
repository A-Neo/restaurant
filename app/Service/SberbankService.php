<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
class SberbankService extends ApiService
{
    public function __construct(LoggerInterface $logger)
    {
        $baseUrl = 'https://api.sberbank.com'; // Примерный URL
        $apiToken = 'sberbank_api_key'; // Ваш API ключ
        parent::__construct($baseUrl, $apiToken, $logger);
    }
    // Инициализация платежа:
    public function initiatePayment($paymentData)
    {
        return $this->post("/payments/initiate", $paymentData);
    }
    // Проверка статуса платежа:
    public function checkPaymentStatus($paymentId)
    {
        return $this->get("/payments/{$paymentId}/status");
    }
    // Отмена платежа:
    public function cancelPayment($paymentId)
    {
        return $this->put("/payments/{$paymentId}/cancel");
    }
    // Возврат средств платежа:
    public function refundPayment($paymentId, $refundData)
    {
        return $this->post("/payments/{$paymentId}/refund", $refundData);
    }
    // Получение списка транзакций:
    public function getTransactions($queryParams)
    {
        return $this->get("/transactions", $queryParams);
    }



}
