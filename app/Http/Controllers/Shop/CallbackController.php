<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Mail\Message;
use App\Mail\Reservation;
use App\Models\Callback;
use App\Models\Messages;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class CallbackController extends Controller
{
    public function index($id, Request $request)
    {
        $setting = Setting::find(1);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|regex:/^[а-яА-ЯёЁ\s]+$/u',
            'phone' => 'required|min:11|regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/',
            'email' => 'required|min:5|email'
        ]);

        if ($validator->fails()) return response()->json(['success' => false, 'error' => $validator->errors()->first()]);

        try {
            if ($id == 3) {
                $callback = Messages::create([
                    'name'    => $request->input('name'),
                    'phone'   => $request->input('phone'),
                    'email'   => $request->input('email'),
                    'theme'   => $request->input('theme'),
                    'message' => $request->input('message'),
                    'status'  => 0,
                ]);

//                Mail::to('grafkrestovsky@mail.ru')->send(new Message($callback->id));
//                Mail::to($setting->mail_two)->send(new Message($callback->id));
            } else {
                $callback = Callback::create([
                    'name'   => $request->input('name'),
                    'phone'  => $request->input('phone'),
                    'email'  => $request->input('email'),
                    'human'  => $request->input('qnt'),
                    'date'   => $request->input('date'),
                    'time'   => $request->input('time'),
                    'type'   => $id,
                    'link'   => url()->previous(),
                    'status' => 0,
                ]);

//                Mail::to('grafkrestovsky@mail.ru')->send(new Reservation($callback->id));
//                Mail::to($request->input('email'))->send(new Reservation($callback->id));
//                Mail::to($setting->mail_two)->send(new Reservation($callback->id));
            }
            $url = $request->input('page');
            if ($url == '') $url = 'home';

            $page = $request->input('page');
            $route = route('page.success', ['page' => $url]);
            Session::put('success', true);
            return response()->json(['success' => true, 'route' => $route]);
        } catch (\Exception $e) {
            //report($e);
            return response()->json(['success' => false, 'error' => 'Произошла ошибка при отправке сообщения.']);
        }
    }

    public function success($page)
    {
        $success = Session::get('success') ?? false;
        if ($success) {
            Session::forget('success');
            $page = Page::find(6);
            $setting = Setting::find(1);
            return view('shop.success', compact('page', 'setting'));
        } else {
            return redirect('/');
        }

    }
}
