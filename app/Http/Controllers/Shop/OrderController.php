<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Models\Algoritm;
use App\Models\DeliveryZone;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $page = Page::find(7);
        $setting = Setting::find(1);
        $products = session()->get('cart');
        $discount = Discount::find(1);

        $dt = Carbon::now()->format('H:i');

        $period = CarbonPeriod::create(Carbon::now()->format('d-m-Y'), Carbon::now()->addDay(7)->format('d-m-Y'));

        $dates = $period->toArray();

        $hour = (int)substr($dt, 0, 2);
        $minute = (int)substr($dt, -2);

        $algoritm = Algoritm::find(1);

        $deliveries = DeliveryZone::all();
        return view('shop.order', compact('page', 'setting', 'products', 'discount', 'hour', 'minute', 'dates', 'algoritm', 'deliveries'));
    }

    public function createOrder(Request $request)
    {

        if ($request->input('instrumentation') === "true") {
            $devices = 1;
        } else {
            $devices = 0;
        }

        $order = Order::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'wishes' => $request->input('text'),
            'method' => $request->input('delivery'),
            'address' => $request->input('street_id'),
            'total' => $request->input('total'),
            'discount' => $request->input('delivery_price'),
            'delivery' => $request->input('delivery_price'),
            'payment_method' => $request->input('payment_type'),
            'payment_status' => 0,
            'devices' => $devices,
        ]);

        $data = session()->get('cart');
        $setting = Setting::find(1);

        // Получаем id товаров
        foreach ($data as $k => $v) {
            $product = Product::where('id', $k)->get()->first();

            Order::find($order->id)->product()->attach([
                $k => ['quantity' => $v['qnt']],
            ]);
        }

        // Mail::to('grafkrestovsky@mail.ru')->send(new Reservation($callback->id));
        Mail::to($order->email)->send(new \App\Mail\Order($order->id));
        Mail::to($setting->mail_two)->send(new \App\Mail\Order($order->id));

        $request->session()->forget('cart');

        if($order->payment_method == '1') {
            $payment = new PaymentController();
            return $payment->create($order->id, $order->total);
        }
    }
}
