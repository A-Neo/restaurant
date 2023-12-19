<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Form;
use App\Models\RandomProduct;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::find($id);
        $reservation = Form::find(1);
        $banquet = Form::find(2);
        $categories = Category::all();
        $random = RandomProduct::find(1);
        $discount = Discount::find(1);

        return view('admin.settings.edit', compact('setting', 'reservation', 'banquet', 'categories', 'random', 'discount'));
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
        $setting = Setting::find($id);
        $reservation = Form::find(1);
        $banquet = Form::find(2);
        $random = RandomProduct::find(1);
        $discount = Discount::find(1);

        $setting->update([
            'phone'          => $request->input('phone'),
            'mail'           => $request->input('mail'),
            'mail_two'       => $request->input('mail_two'),
            'time_ru'        => $request->input('time_ru'),
            'time_en'        => $request->input('time_en'),
            'delivery_ru'    => $request->input('delivery_ru'),
            'delivery_en'    => $request->input('delivery_en'),
            'street_ru'      => $request->input('street_ru'),
            'street_en'      => $request->input('street_en'),
            'instagram_link' => $request->input('instagram_link'),
            'facebook_link'  => $request->input('facebook_link'),
            'tiktok_link'    => $request->input('tiktok_link'),
            'overlay'        => $request->input('overlay'),
            'en_on'          => $request->input('en_on'),
            'max_distance'   => $request->input('max_distance'),
        ]);

        $discount->update([
            'discount' => $request->input('discount'),
        ]);

        $reservation->update([
            'max_human' => $request->input('table_reservation'),
        ]);
        $banquet->update([
            'max_human' => $request->input('banquet'),
        ]);

        $random->update([
            'category_id' => $request->input('category_id'),
        ]);

        if ($request->hasFile('logo')) {
            $setting->update([
                'logo' => $request->file('logo')->store("settings"),
            ]);
        }

        if ($request->hasFile('logo_b')) {
            $setting->update([
                'logo_b' => $request->file('logo_b')->store("settings"),
            ]);
        }

        $request->session()->flash('success', 'Настройки сайта - изменены');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
