<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $page = Page::find(5);
        $addition = Addition::find(1);
        $setting = Setting::find(1);

        return view('shop.booking', compact('page', 'addition', 'setting'));
    }
}
