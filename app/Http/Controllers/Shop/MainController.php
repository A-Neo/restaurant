<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Addition;
use App\Models\Banner;
use App\Models\Beverage;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Food;
use App\Models\Page;
use App\Models\RandomProduct;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $page = Page::find(2);

        $banners = Banner::all()->sortBy('order');
        $about = About::find(1);
        $addition = Addition::find(1);
        $reservation = Reservation::find(1);
        $chef = Chef::find(1);
        $reviews = Review::all();
        $setting = Setting::find(1);

        $menu = Food::where('title_ru', 'Основное меню')->first()->slug;

        $random = RandomProduct::find(1)->category_id;
        
        $category = Category::find($random);
        
        $products = null;
        
        if($category) {
            $products = $category->products->take(10);
        }

        

        return view('shop.index', compact(
            'banners',
            'about',
            'addition',
            'reservation',
            'chef',
            'reviews',
            'setting',
            'page',
            'menu',
            'products'
        ));
    }

    /**
     * @param $slug
     * @return mixed
     */

    public function food($slug)
    {
        return $slug;
    }

    public function beverage($slug)
    {
        return $slug;
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLocale($locale)
    {
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
}
