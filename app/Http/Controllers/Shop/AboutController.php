<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::find(8);
        $addition = Addition::find(1);
        $setting = Setting::find(1);

        return view('shop.about', compact('page', 'addition', 'setting'));
    }
}
