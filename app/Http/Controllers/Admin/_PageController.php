<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function deleteSlide($id)
    {
        $page = Page::find($id);
        $page->sliders()->detach(request()->input('image'));

        return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.pages.edit', compact('page'));
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

        $page = Page::find($id);

        $page->update([
            'title_ru'           => $request->input('title_ru'),
            'title_en'           => $request->input('title_en'),
            'subtitle_ru'        => $request->input('subtitle_ru'),
            'subtitle_en'        => $request->input('subtitle_en'),
            'pdf_ru'             => $request->input('pdf_ru'),
            'pdf_en'             => $request->input('pdf_en'),
            'meta_title'         => $request->input('meta_title'),
            'meta_description'   => $request->input('meta_description'),
            'meta_keywords'      => $request->input('meta_keywords'),
        ]);

        if ($page->id == 4 || $page->id == 8 || $page->id == 9 || $page->id == 10 || $page->id == 11 || $page->id == 12) {
            $page->update(['description_ru' => $request->input('description_ru'),'description_en' => $request->input('description_en')]);
        }

        if ($request->hasFile('image')) $page->update(['image' => $request->file('image')->store("pages")]);

        if ($request->hasFile('pdf_file')) {
            $name = $request->file('pdf_file')->getClientOriginalName();
            $page->update(['pdf_file' => $request->file('pdf_file')->storeAs('pdf', $name)]);
        }

        if ($request->hasFile('sliders')) {
            // Добавляем новые изображения в папку
            $folder = 'page_sliders';
            foreach ($request->file('sliders') as $key => $value) {
                $image = Image::create(['image' => $value->store("$folder")]);
                $page->sliders()->attach($image->id);
            }
        }

        $request->session()->flash('success', 'Страница обновлена');

        return redirect()->route('pages.index');
    }
}
