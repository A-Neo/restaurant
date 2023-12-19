<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beverage;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function type($type)
    {

       if ($type === '0') {
           $categories = Category::where('type', 0)->paginate(15);
           $title = 'Еда';

           return view('admin.categories.index', compact('categories', 'title', 'type'));
       } else {
           $categories = Category::where('type', 1)->paginate(15);
           $title = 'Напитки';

           return view('admin.categories.index', compact('categories', 'title', 'type'));
       }
    }
    /**
     * @param $type
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * @param $type
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $str = explode('type/', url()->previous());
        $type= ltrim($str[1])[0];

        if ($type === '0') {
            $categories = Food::all();
        } else {
            $categories = Beverage::all();
        }

        return view('admin.categories.create', compact('categories','type'));
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

        $type = $request->input('type');

        $category = Category::create([
            'title_ru'      => $request->input('title_ru'),
            'title_en'      => $request->input('title_en'),
            'type'          => $type,
            'order'         => $request->input('order'),
        ]);

        if ($type === '0') {
            $category->foods()->sync($request->categories);
        } else {
            $category->beverages()->sync($request->categories);
        }

        $request->session()->flash('success', 'Категория добавлена');

        return redirect()->route('admin.categories.type', [$type]);
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
        $category = Category::find($id);
        $type = $category->type;


        if ($type === 0) {
            $categories = Food::all();
        } else {
            $categories = Beverage::all();
        }

        return view('admin.categories.edit', compact('category', 'categories','type'));
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

        $type = $request->input('type');

        $category = Category::find($id);

        $category->update([
            'title_ru'      => $request->input('title_ru'),
            'title_en'      => $request->input('title_en'),
            'order'         => $request->input('order'),
        ]);

        if ($type === '0') {
            $category->foods()->sync($request->categories);
        } else {
            $category->beverages()->sync($request->categories);
        }

        $request->session()->flash('success', 'Категория обновлена');

        return redirect()->route('admin.categories.type', [$type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $type = $category->type;

        $category->delete();

        return redirect()->route('admin.categories.type', [$type])->with('success', 'Категория удалена');
    }
}
