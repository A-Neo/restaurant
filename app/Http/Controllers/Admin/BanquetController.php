<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banquet;
use App\Models\Image;
use Illuminate\Http\Request;

class BanquetController extends Controller
{

    public function deleteSlide($id)
    {
        $banquet = Banquet::find($id);
        $banquet->sliders()->detach(request()->input('image'));

        return true;
    }

    public function onlyTrash()
    {
        $items = Banquet::onlyTrashed()->get();
        return view('admin.banquets.trash', compact('items'));
    }

    public function restoreModel($id)
    {
        $item = Banquet::onlyTrashed()
            ->where('id', $id)
            ->first();

        $item->restore();
        return redirect()->route('admin.banquets.index')->with('success', 'Запись восстановлена');
    }

    public function fullDelete($id)
    {
        $item = Banquet::find($id);
        $item->forceDelete();
        return redirect()->route('admin.banquets.index')->with('success', 'Запись полностью удалена');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $banquets = Banquet::paginate(15);
        return view('admin.banquets.index', compact('banquets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banquets.create');
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

        $banquet = Banquet::create([
            'title_ru'           => $request->input('title_ru'),
            'title_en'           => $request->input('title_en'),
            'description_ru' => $request->input('description_ru'),
            'description_en' => $request->input('description_en'),
            'subtitle_ru'        => $request->input('subtitle_ru'),
            'subtitle_en'        => $request->input('subtitle_en'),
            'meta_title'         => $request->input('meta_title'),
            'meta_description'   => $request->input('meta_description'),
            'meta_keywords'      => $request->input('meta_keywords'),
        ]);

        if ($request->hasFile('image')) $banquet->update(['image' => $request->file('image')->store("banquets")]);

        if ($request->hasFile('sliders')) {
            // Добавляем новые изображения в папку
            $folder = 'banquet_sliders';
            foreach ($request->file('sliders') as $key => $value) {
                $image = Image::create(['image' => $value->store("$folder")]);
                $banquet->sliders()->attach($image->id);
            }
        }

        $request->session()->flash('success', 'Запись создана');

        return redirect()->route('admin.banquets.index');
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
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $banquet = Banquet::find($id);
        return view('admin.banquets.edit', compact('banquet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title_ru' => 'required',
        ]);

        $banquet = Banquet::find($id);

        $banquet->update([
            'title_ru'           => $request->input('title_ru'),
            'title_en'           => $request->input('title_en'),
            'description_ru' => $request->input('description_ru'),
            'description_en' => $request->input('description_en'),
            'subtitle_ru'        => $request->input('subtitle_ru'),
            'subtitle_en'        => $request->input('subtitle_en'),
            'meta_title'         => $request->input('meta_title'),
            'meta_description'   => $request->input('meta_description'),
            'meta_keywords'      => $request->input('meta_keywords'),
        ]);

        if ($request->hasFile('image')) $banquet->update(['image' => $request->file('image')->store("banquets")]);

        if ($request->hasFile('sliders')) {
            // Добавляем новые изображения в папку
            $folder = 'banquet_sliders';
            foreach ($request->file('sliders') as $key => $value) {
                $image = Image::create(['image' => $value->store("$folder")]);
                $banquet->sliders()->attach($image->id);
            }
        }

        $request->session()->flash('success', 'Запись обновлена');

        return redirect()->route('admin.banquets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = Banquet::find($id);
        $path = public_path("uploads/$item->main_image");
        if(is_file(str_replace('\\', '/', $path))) unlink(str_replace('\\', '/', $path));
        $item->delete();
        return redirect()->route('admin.banquets.index')->with('success', 'Запись удалена!');
    }
}
