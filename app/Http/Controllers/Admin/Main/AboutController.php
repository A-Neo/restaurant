<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $about = About::find($id);
        return view('admin.main.abouts.edit', compact('about'));
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
            'subtitle_ru' => 'required',
        ]);

        $about = About::find($id);

        $about->update([
            'subtitle_ru'   => $request->input('subtitle_ru'),
            'subtitle_en'   => $request->input('subtitle_en'),
            'describe_ru'   => $request->input('describe_ru'),
            'describe_en'   => $request->input('describe_en'),
            'btn_ru'        => $request->input('btn_ru'),
            'btn_en'        => $request->input('btn_en'),
            'btn_link'      => $request->input('btn_link'),
        ]);

        if ($request->hasFile('image')) {
            $about->update([
                'image' => $request->file('image')->store("abouts"),
            ]);
        }

        $request->session()->flash('success', 'Блок о нас на главной - обновлен');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
