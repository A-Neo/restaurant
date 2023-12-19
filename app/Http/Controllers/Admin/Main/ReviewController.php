<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::paginate(15);
        return view('admin.main.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.main.reviews.create');
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
            'name_ru' => 'required',
        ]);

        $review = Review::create([
            'name_ru'          => $request->input('name_ru'),
            'name_en'          => $request->input('name_en'),
            'description_ru'    => $request->input('description_ru'),
            'description_en'    => $request->input('description_en'),
        ]);

        if ($request->hasFile('image')) {
            $review->update([
                'image' => $request->file('image')->store("reviews"),
            ]);
        }

        $request->session()->flash('success', 'Отзыв - добавлен');

        return redirect()->route('reviews.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);
        return view('admin.main.reviews.edit', compact('review'));
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
            'name_ru' => 'required',
        ]);

        $review = Review::find($id);

        $review->update([
            'name_ru'          => $request->input('name_ru'),
            'name_en'          => $request->input('name_en'),
            'description_ru'    => $request->input('description_ru'),
            'description_en'    => $request->input('description_en'),
        ]);

        if ($request->hasFile('image')) {
            $review->update([
                'image' => $request->file('image')->store("reviews"),
            ]);
        }

        $request->session()->flash('success', 'Отзыв - обновлен');

        return redirect()->route('reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Отзыв удален');
    }
}
