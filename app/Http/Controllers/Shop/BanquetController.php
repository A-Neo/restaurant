<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use App\Models\Banquet;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class BanquetController extends Controller
{
    public function index()
    {
        $page = Page::find(4);
        $addition = Addition::find(1);
        $setting = Setting::find(1);
        return view('shop.banquet', compact('page', 'addition', 'setting'));
    }

    public function show($slug)
    {
        $page = Banquet::where('slug', $slug)->first();
        $addition = Addition::find(1);
        $setting = Setting::find(1);
        return view('shop.banquet', compact('page', 'addition', 'setting'));
    }
}
