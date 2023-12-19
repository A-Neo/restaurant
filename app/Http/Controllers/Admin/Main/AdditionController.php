<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use Illuminate\Http\Request;

class AdditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $addition = Addition::find($id);
        return view('admin.main.additions.edit', compact('addition'));
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

        $addition = Addition::find($id);

        $addition->update([
            'title_ru'          => $request->input('title_ru'),
            'title_en'          => $request->input('title_en'),
            'description_ru'    => $request->input('description_ru'),
            'description_en'    => $request->input('description_en'),
            'btn_ru'            => $request->input('btn_ru'),
            'btn_en'            => $request->input('btn_en'),
            'btn_link'          => $request->input('btn_link'),
            'apple_link'        => $request->input('apple_link'),
            'google_link'       => $request->input('google_link'),
        ]);

        if ($request->hasFile('image')) {
            $addition->update([
                'image' => $request->file('image')->store("additions"),
            ]);
        }

        $request->session()->flash('success', 'Блок наше приложение - обновлен');

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
