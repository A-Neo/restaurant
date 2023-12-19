<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Image;
use App\Models\Rubric;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function deleteSlide($id)
    {
        $article = Article::find($id);
        $article->sliders()->detach(request()->input('image'));

        return true;
    }

    public function deleteGallery($id)
    {
        $article = Article::find($id);
        $article->galleries()->detach(request()->input('image'));

        return true;
    }

    public function onlyTrash()
    {
        $items = Article::onlyTrashed()->get();
        return view('admin.articles.trash', compact('items'));
    }

    public function restoreModel($id)
    {
        $item = Article::onlyTrashed()
            ->where('id', $id)
            ->first();

        $item->restore();
        return redirect()->route('admin.articles.index')->with('success', 'Статья восстановлена');
    }

    public function fullDelete($id)
    {
        $item = Article::find($id);
        $item->forceDelete();
        return redirect()->route('admin.articles.index')->with('success', 'Статья полностью удалена');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rubrics = Rubric::all();
        return view('admin.articles.create', compact('rubrics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_ru' => 'required',
        ]);

        $article = Article::create([
            'title_ru'                  => $request->input('title_ru'),
            'title_en'                  => $request->input('title_en'),
            'description_ru'            => $request->input('description_ru'),
            'description_en'            => $request->input('description_en'),
            'form'                      => $request->input('form'),
            'rubric'                    => $request->input('rubric'),
            'order'                     => $request->input('order'),
            'meta_title'                => $request->input('meta_title'),
            'meta_description'          => $request->input('meta_description'),
            'meta_keywords'             => $request->input('meta_keywords'),
        ]);

        if ($request->hasFile('image')) {
            $article->update([
                'image' => $request->file('image')->store("articles"),
            ]);
        }

        if ($request->hasFile('sliders')) {
            // Добавляем новые изображения в папку
            $folder = 'sliders';
            foreach ($request->file('sliders') as $key => $value) {
                $image = Image::create(['image' => $value->store("$folder")]);
                $article->sliders()->attach($image->id);
            }
        }

        if ($request->hasFile('galleries')) {
            // Добавляем новые изображения в папку
            $folder = 'galleries';
            foreach ($request->file('galleries') as $key => $value) {
                $image = Image::create(['image' => $value->store("$folder")]);
                $article->galleries()->attach($image->id);
            }
        }

        $request->session()->flash('success', 'Статья добавлена');

        return redirect()->route('admin.articles.index');
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
        $article = Article::find($id);
        $rubrics = Rubric::all();

        return view('admin.articles.edit', compact('article', 'rubrics'));
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
        $request->validate([
            'title_ru' => 'required',
        ]);

        $article = Article::find($id);

        if($article->title_ru !== $request->input('title_ru')) {
            $article->slug = null;
        }

        $article->update([
            'title_ru'                  => $request->input('title_ru'),
            'title_en'                  => $request->input('title_en'),
            'description_ru'            => $request->input('description_ru'),
            'description_en'            => $request->input('description_en'),
            'form'                      => $request->input('form'),
            'rubric'                    => $request->input('rubric'),
            'order'                     => $request->input('order'),
            'meta_title'                => $request->input('meta_title'),
            'meta_description'          => $request->input('meta_description'),
            'meta_keywords'             => $request->input('meta_keywords'),
        ]);

        if ($request->hasFile('image')) {
            $article->update([
                'image' => $request->file('image')->store("articles"),
            ]);
        }


        if ($request->hasFile('sliders')) {
            // Добавляем новые изображения в папку
            $folder = 'sliders';
            foreach ($request->file('sliders') as $key => $value) {
                $image = Image::create(['image' => $value->store("$folder")]);
                $article->sliders()->attach($image->id);
            }
        }

        if ($request->hasFile('galleries')) {
            // Добавляем новые изображения в папку
            $folder = 'galleries';
            foreach ($request->file('galleries') as $key => $value) {
                $image = Image::create(['image' => $value->store("$folder")]);
                $article->galleries()->attach($image->id);
            }
        }

        $request->session()->flash('success', 'Статья обновлена');

        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Статья удалена');
    }
}
