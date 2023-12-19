<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function index()
    {
        $page = Page::find(12);
        $addition = Addition::find(1);
        $setting = Setting::find(1);
        return view('shop.children', compact('page', 'addition', 'setting'));
    }

    public function testing()
    {
        $page = Page::find(12);
        $addition = Addition::find(1);
        $setting = Setting::find(1);
        return view('shop.testing', compact('page', 'addition', 'setting'));
    }
}
