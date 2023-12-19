<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
class LoCardsService extends ApiService
{
    public function __construct(LoggerInterface $logger)
    {
        $baseUrl = 'https://api.locards.com';
        $apiToken = 'apikey'; // Ваш API ключ
        parent::__construct($baseUrl, $apiToken, $logger);
    }

    // Получение информации о карте:
    public function getCardInfo($cardId)
    {
        return $this->get("/cards/{$cardId}");
    }
    // Активация карты:
    public function activateCard($cardId, $activationData)
    {
        return $this->put("/cards/{$cardId}/activate", $activationData);
    }
    // Блокировка карты:
    public function blockCard($cardId)
    {
        return $this->put("/cards/{$cardId}/block");
    }
    // Загрузка баланса карты
    public function getCardBalance($cardId)
    {
        return $this->get("/cards/{$cardId}/balance");
    }
    // Проведение транзакции:
    public function makeTransaction($transactionData)
    {
        return $this->post("/transactions", $transactionData);
    }
}
