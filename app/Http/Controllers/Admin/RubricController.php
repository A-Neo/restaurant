<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rubric;
use Illuminate\Http\Request;

class RubricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubrics = Rubric::paginate(15);
        return view('admin.rubrics.index', compact('rubrics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rubrics.create');
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

        $rubric = Rubric::create([
            'title_ru'                  => $request->input('title_ru'),
            'title_en'                  => $request->input('title_en'),
            'order'                     => $request->input('order'),
            'meta_title'                => $request->input('meta_title'),
            'meta_description'          => $request->input('meta_description'),
            'meta_keywords'             => $request->input('meta_keywords'),
        ]);

        if ($request->hasFile('image')) {
            $rubric->update([
                'image' => $request->file('image')->store("rubrics"),
            ]);
        }

        $request->session()->flash('success', 'Рубрика добавлена');

        return redirect()->route('admin.rubrics.index');
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
        $rubric = Rubric::find($id);
        return view('admin.rubrics.edit', compact('rubric'));
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

        $rubric = Rubric::find($id);

        $rubric->update([
            'title_ru'           => $request->input('title_ru'),
            'title_en'           => $request->input('title_en'),
            'order'              => $request->input('order'),
            'meta_title'         => $request->input('meta_title'),
            'meta_description'   => $request->input('meta_description'),
            'meta_keywords'      => $request->input('meta_keywords'),
        ]);

        if ($request->hasFile('image')) {
            $rubric->update([
                'image' => $request->file('image')->store("rubrics"),
            ]);
        }

        $request->session()->flash('success', 'Рубрика обновлена');

        return redirect()->route('admin.rubrics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rubric = Rubric::find($id);

        $rubric->delete();

        return redirect()->route('admin.rubrics.index')->with('success', 'Рубрика удалена');
    }
}
