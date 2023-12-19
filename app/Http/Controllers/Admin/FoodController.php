<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function onlyTrash()
    {
        $items = Food::onlyTrashed()->get();
        return view('admin.foods.trash', compact('items'));
    }

    public function restoreModel($id)
    {
        $item = Food::onlyTrashed()
            ->where('id', $id)
            ->first();

        $item->restore();
        return redirect()->route('admin.foods.index')->with('success', 'Запись восстановлена');
    }

    public function fullDelete($id)
    {
        $item = Food::find($id);
        $item->forceDelete();
        return redirect()->route('admin.foods.index')->with('success', 'Запись полностью удалена');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::paginate(15);
        return view('admin.foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.foods.create');
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

        $food = Food::create([
            'title_ru'                  => $request->input('title_ru'),
            'title_en'                  => $request->input('title_en'),
            'subtitle_ru'               => $request->input('subtitle_ru'),
            'subtitle_en'               => $request->input('subtitle_en'),
            'order'                     => $request->input('order'),
            'meta_title'                => $request->input('meta_title'),
            'meta_description'          => $request->input('meta_description'),
            'meta_keywords'             => $request->input('meta_keywords'),
        ]);

        if ($request->hasFile('image')) {
            $food->update([
                'image' => $request->file('image')->store("foods"),
            ]);
        }

        $request->session()->flash('success', 'Пункт меню добавлен');

        return redirect()->route('admin.foods.index');
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
        $food = Food::find($id);
        return view('admin.foods.edit', compact('food'));
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

        $food = Food::find($id);

        $food->update([
            'title_ru'           => $request->input('title_ru'),
            'title_en'           => $request->input('title_en'),
            'subtitle_ru'        => $request->input('subtitle_ru'),
            'subtitle_en'        => $request->input('subtitle_en'),
            'order'              => $request->input('order'),
            'meta_title'         => $request->input('meta_title'),
            'meta_description'   => $request->input('meta_description'),
            'meta_keywords'      => $request->input('meta_keywords'),
        ]);

        if ($request->hasFile('image')) {
            $food->update([
                'image' => $request->file('image')->store("foods"),
            ]);
        }

        $request->session()->flash('success', 'Пункт меню обновлен');

        return redirect()->route('admin.foods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);

        $food->delete();

        return redirect()->route('admin.foods.index')->with('success', 'Пункт меню удален');
    }
}
