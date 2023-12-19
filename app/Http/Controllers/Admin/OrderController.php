<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $street = Address::find($order->address) ?? null;

        return view('admin.orders.show', compact('order', 'street'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if ($request->input('instrumentation') === "true") {
            $devices = 1;
        } else {
            $devices = 0;
        }

        $order->create([
            'name'              => $request->input('name'),
            'email'             => $request->input('email'),
            'phone'             => $request->input('phone'),
            'date'              => $request->input('date'),
            'time'              => $request->input('time'),
            'wishes'            => $request->input('text'),
            'method'            => $request->input('delivery'),
            'address'           => $request->input('street_id'),
            'total'             => $request->input('total'),
            'discount'          => $request->input('delivery_price'),
            'delivery'          => $request->input('delivery_price'),
            'payment_method'    => $request->input('payment_type'),
            'devices'           => $devices,
        ]);

        $request->session()->flash('success', 'Заказ обновлен');

        return redirect()->route('admin.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Заказ удален');
    }
}
