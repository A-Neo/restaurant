<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::paginate(15);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
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
            'order' => 'required',
        ]);

        $banner = Banner::create([
            'title_ru'      => $request->input('title_ru'),
            'title_en'      => $request->input('title_en'),
            'subtitle_ru'   => $request->input('subtitle_ru'),
            'subtitle_en'   => $request->input('subtitle_en'),
            'btn_ru'        => $request->input('btn_ru'),
            'btn_en'        => $request->input('btn_en'),
            'btn_link'      => $request->input('btn_link'),
            'video_link'    => $request->input('video_link'),
            'mode_bg'       => $request->input('mode_bg'),
            'mode_content'  => $request->input('mode_content'),
            'mode_align'    => $request->input('mode_align'),
            'order'         => $request->input('order'),
        ]);

        if ($request->hasFile('bg_image')) {
            $banner->update([
                'bg_image' => $request->file('bg_image')->store("banners"),
            ]);
        }

        if ($request->hasFile('image')) {
            $banner->update([
                'image' => $request->file('image')->store("banners"),
            ]);
        }

        $request->session()->flash('success', 'Баннер добавлен');

        return redirect()->route('admin.banners.index');
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
        $banner = Banner::find($id);
        return view('admin.banners.edit', compact('banner'));
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
            'order' => 'required',
        ]);

        $banner = Banner::find($id);

        $banner->update([
            'title_ru'      => $request->input('title_ru'),
            'title_en'      => $request->input('title_en'),
            'subtitle_ru'   => $request->input('subtitle_ru'),
            'subtitle_en'   => $request->input('subtitle_en'),
            'btn_ru'        => $request->input('btn_ru'),
            'btn_en'        => $request->input('btn_en'),
            'btn_link'      => $request->input('btn_link'),
            'video_link'    => $request->input('video_link'),
            'mode_bg'       => $request->input('mode_bg'),
            'mode_content'  => $request->input('mode_content'),
            'mode_align'    => $request->input('mode_align'),
            'order'         => $request->input('order'),
        ]);


        if ($request->hasFile('bg_image')) {
            $banner->update([
                'bg_image' => $request->file('bg_image')->store("banners"),
            ]);
        }

        if ($request->hasFile('image')) {
            $banner->update([
                'image' => $request->file('image')->store("banners"),
            ]);
        }

        $request->session()->flash('success', 'Баннер обновлен');

        return redirect()->route('admin.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Баннер удален');
    }
}
