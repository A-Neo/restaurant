<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Beverage;
use App\Models\Category;
use App\Models\Food;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function food($slug)
    {
        $setting = Setting::find(1);
        $categories = Food::where('slug', $slug)->first();
        $menus = $categories->categories->sortBy('order');
        return view('shop.food', compact('categories','menus', 'setting'));
    }
    public function beverage($slug)
    {
        $setting = Setting::find(1);
        $categories = Beverage::where('slug', $slug)->first();
        $menus = $categories->categories->sortBy('order');

        return view('shop.beverage', compact('categories','menus', 'setting'));
    }

}
