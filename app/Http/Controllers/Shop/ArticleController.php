<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use App\Models\Rubric;
use App\Models\Setting;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index($slug = null)
    {
        $page = Page::find(3);
        $rubrics = Rubric::all();
        $randoms = Article::inRandomOrder()->limit(5)->get();;
        $setting = Setting::find(1);

        if (!$slug) {
            $articles = Article::orderBy('created_at', 'desc')->paginate(5);
        } else {
            $rubric = Rubric::where('slug', $slug)->first();
            if ($rubric) {
                $articles = Article::where('rubric', $rubric->id)->orderBy('created_at', 'desc')->paginate(5);
            } else {
                abort(404);
            }

        }

        return view('shop.articles', compact('articles','page', 'rubrics', 'randoms', 'setting'));
    }

    public function article($slug)
    {
        $setting = Setting::find(1);

        $page = Page::find(3);
        $rubrics = Rubric::all();
        $randoms = Article::inRandomOrder()->limit(5)->get();;

        $article = Article::where('slug', $slug)->first();

        return view('shop.article', compact('article','page', 'rubrics', 'randoms', 'setting'));
    }
}
