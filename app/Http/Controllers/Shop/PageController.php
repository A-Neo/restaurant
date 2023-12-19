<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function policy()
    {
        $page = Page::find(10);
        return view('shop.page', compact('page'));
    }

    public function personal()
    {
        $page = Page::find(9);
        return view('shop.page', compact('page'));
    }

    public function offers()
    {
        $page = Page::find(11);
        return view('shop.page', compact('page'));
    }
}
