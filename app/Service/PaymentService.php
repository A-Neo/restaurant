<?php


namespace App\Service;

use YooKassa\Client;


class PaymentService
{
    public function getClient(): Client
    {
        $client = new Client();
        $client->setAuth(config('services.yookassa.shop_id'), config('services.yookassa.secret_key'));

        return $client;
    }

    public function createPayment($amount, $description, $options = [])
    {
        $client = $this->getClient();
        $payment = $client->createPayment([
            'amount' => [
                'value' => $amount,
                'currency' => 'RUB',
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('home'),
            ],
            'capture' => false,
            'meta_data' => [
                'order_id' => $options['order_id']
            ],
            'description' => $description
        ], uniqid('', true));

        return $payment->getConfirmation()->getConfirmationUrl();
    }
}
