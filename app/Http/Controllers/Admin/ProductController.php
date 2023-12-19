<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as ImageSize;

class ProductController extends Controller
{
     public function onlyTrash()
    {
        $items = Product::onlyTrashed()->get();
        return view('admin.products.trash', compact('items'));
    }

    public function restoreModel($id)
    {
        $item = Product::onlyTrashed()
            ->where('id', $id)
            ->first();

        $item->restore();
        return redirect()->route('admin.products.index')->with('success', 'Блюдо восстановлена');
    }

    public function fullDelete($id)
    {
        $item = Product::find($id);
        $item->forceDelete();
        return redirect()->route('admin.products.index')->with('success', 'Блюдо полностью удалена');
    }
    public function destoryImages($id)
    {
        $image = Image::where('id', $id)->first();
        if(is_file(str_replace('\\', '/', public_path("uploads/$image->image")))) {
            unlink(str_replace('\\', '/', public_path("uploads/$image->image")));
        }
        $image->delete();
        return redirect()->back()->with('success', 'Дополниельное изображение удалено');
    }

    public function delivery(Request $request)
    {
        $id = $request->input('id');
        $value = $request->input('value');

        $product = Product::find($id);
        $product->update([
            'delivery' => $value
        ]);

        return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);
        $s = null;
        return view('admin.products.index', compact('products', 's'));
    }

    public function search(Request $request)
    {
        $products = Product::where('title_ru', 'LIKE', "%$request->s%")->paginate(25);
        $s = $request->s;
        return view('admin.products.index', compact('products', 's'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foods = Category::where('type', 0)->get();
        $beverages = Category::where('type', 1)->get();
        $attributes = Attribute::all();
        return view('admin.products.create', compact('foods', 'beverages', 'attributes'));
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

        $product = Product::create([
            'title_ru'              => $request->input('title_ru'),
            'title_en'              => $request->input('title_en'),
            'describe_ru'           => $request->input('describe_ru'),
            'describe_en'           => $request->input('describe_en'),
            'description_ru'        => $request->input('description_ru'),
            'description_en'        => $request->input('description_en'),
            'quantity'              => $request->input('quantity'),
            'weight'                => $request->input('weight'),
            'price'                 => $request->input('price'),
            'order'                 => $request->input('order'),
            'delivery'              => $request->input('delivery'),
            'meta_title'            => $request->input('meta_title'),
            'meta_description'      => $request->input('meta_description'),
            'meta_keywords'         => $request->input('meta_keywords'),
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();

            //$filename_one = uniqid() . '.' . $extension;
            $filename_two = uniqid() . '.' . $extension;


            //$image_resize_one = ImageSize::make($image->getRealPath())->resize(384, 210);
            $image_resize_two = ImageSize::make($image->getRealPath())->resize(550, 400);



            //$image_resize_one->save(public_path('uploads\product\\' .$filename_one));
            $image_resize_two->save(public_path('uploads\product\\' .$filename_two));

            $product->update([
                'image' => 'product/' . $filename_two,
                'image_full' => 'product/' . $filename_two,
            ]);
        }

        $images = [];

        if ($request->hasFile('images')) {
            // Добавляем новые изображения в папку
            foreach ($request->file('images') as $key => $value) {
                $extension = $value->getClientOriginalExtension();
                $filename = uniqid() . '.' . $extension;
                $image_resize = ImageSize::make($value->getRealPath())->resize(550, 400);

                $image_resize->save(public_path('uploads\product\\' .$filename));

                $images[] = 'product\\' . $filename;
            }
        }

        // Сохраняем новые изображение в таблицу Image
        if ($images) {
            foreach ($images as $image) {
                Image::create(['product_id' => $product->id, 'image' => $image]);
            }
        }

        // Синхронизируем категории

        $product->categories()->sync($request->categories);

        if ($request->input('attribute')) {
            foreach ($request->input('attribute') as $k => $v) {
                if ($v) {
                    Attribute::find($k)->product()->attach([
                        $product->id => ['value' => $v],
                    ]);
                }
            }
        }


        $request->session()->flash('success', 'Товар добавлена');

        return redirect()->route('admin.products.index');
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
        $product = Product::find($id);
        $attributes = Attribute::all();
        $product_attributes = $product->attributes;
        $foods = Category::where('type', 0)->get();
        $beverages = Category::where('type', 1)->get();

        return view('admin.products.edit', compact('product', 'attributes', 'product_attributes', 'foods', 'beverages'));
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

        $product = Product::find($id);

        $product->update([
            'title_ru'              => $request->input('title_ru'),
            'title_en'              => $request->input('title_en'),
            'describe_ru'           => $request->input('describe_ru'),
            'describe_en'           => $request->input('describe_en'),
            'description_ru'        => $request->input('description_ru'),
            'description_en'        => $request->input('description_en'),
            'quantity'              => $request->input('quantity'),
            'weight'                => $request->input('weight'),
            'price'                 => $request->input('price'),
            'order'                 => $request->input('order'),
            'delivery'              => $request->input('delivery'),
            'meta_title'            => $request->input('meta_title'),
            'meta_description'      => $request->input('meta_description'),
            'meta_keywords'         => $request->input('meta_keywords'),
        ]);

        if ($request->file('image')) {
            $product->update([
                'image' => $request->file('image')->store("product")
            ]);
        }

        $images = [];

        if ($request->hasFile('images')) {
            // Добавляем новые изображения в папку
            $folder = 'product';
            foreach ($request->file('images') as $key => $value) {
                $images[] = $value->store("$folder");
            }
        }

        // Сохраняем новые изображение в таблицу Image
        if ($images) {
            foreach ($images as $image) {
                Image::create(['product_id' => $product->id, 'image' => $image]);
            }
        }

        // Обновляем категории

        $product->categories()->sync($request->categories);

        // Обновляем атрибуты

        if ($request->input('attribute')) {
            $product->attributes()->detach();

            foreach ($request->input('attribute') as $k => $v) {
                if ($v) {
                    Attribute::find($k)->product()->attach([
                        $product->id => ['value' => $v],
                    ]);
                }
            }
        }

        $request->session()->flash('success', 'Блюдо изменено');

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Блюдо удалено');
    }
}
