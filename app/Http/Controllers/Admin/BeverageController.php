<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beverage;
use Illuminate\Http\Request;

class BeverageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beverages = Beverage::paginate(15);
        return view('admin.beverages.index', compact('beverages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.beverages.create');
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

        $beverage = Beverage::create([
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
            $beverage->update([
                'image' => $request->file('image')->store("beverages"),
            ]);
        }

        $request->session()->flash('success', 'Пункт меню добавлен');

        return redirect()->route('admin.beverages.index');
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
        $beverage = Beverage::find($id);
        return view('admin.beverages.edit', compact('beverage'));
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

        $beverage = Beverage::find($id);

        $beverage->update([
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
            $beverage->update([
                'image' => $request->file('image')->store("beverages"),
            ]);
        }

        $request->session()->flash('success', 'Пункт меню обновлен');

        return redirect()->route('admin.beverages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beverage = Beverage::find($id);

        $beverage->delete();

        return redirect()->route('admin.beverages.index')->with('success', 'Пункт меню удален');
    }
}
