<?php

namespace App\Service;

use App\Models\Category;
use App\Models\Product;

class CategoryService
{
    public function getBySlugOrId($slug, $id)
    {
        return $slug ? Category::where('slug', $slug)->get() : Category::find($id);
    }

    public function renderCategoryView($categories)
    {
        return view('components.delivery', compact('categories'))->render();
    }

    public function getCategories($slug = null)
    {
        return $slug ? Category::where('type', 0)->where('slug', $slug)->orderBy('order')->get() : Category::where('type', 0)->orderBy('order')->get();
    }

    public function getPaginatedProducts($request)
    {
        $perPage = 15;
        return Product::whereHas('categories', function ($query) use ($request) {
            $query->delivery()->when($request->slug, function ($query, $slug) {
                return $query->where('slug', $slug);
            });
        })->paginate($perPage);
    }
}
