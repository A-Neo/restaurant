<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Service\PaymentService;
use Illuminate\Http\Request;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;
use YooKassa\Model\NotificationEventType;

class PaymentController extends Controller
{
    public function index()
    {

    }

    public function create($order_id, $total)
    {
        $amount = $total;
        $description = 'Оплата с сайта';

        $service = new PaymentService();

        $link = $service->createPayment($amount, $description, [
            'order_id' => $order_id
        ]);

        return $link;
    }

    public function callback(Request $request, PaymentService $service)
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);

        $notification = (isset($requestBody['event']) && $requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);

        $payment = $notification->getObject();

        if (isset($payment->status) && $payment->status === 'succeeded') {
            if ($payment->paid === true) {
                $metadata = $payment->metadata;
                if (isset($metadata->order_id)) {
                    $order_id = $metadata->order_id;
                    $order = Order::where('id', $order_id)->first();
                    $order->payment_status = 1;
                    $order->save;
                }
            }
        }
    }
}
