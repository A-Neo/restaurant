<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request, $slug = null)
    {
        $setting = Setting::find(1);
        $page = Page::find(1);
        $categories = $this->categoryService->getCategories($slug);
        // Новый метод для получения продуктов с пагинацией
        $products = $this->categoryService->getPaginatedProducts($request);

        return view('shop.delivery', compact('page', 'setting', 'categories', 'products'));
    }

    public function update(Request $request)
    {
        $slug = $request->input('slug');
        $categories = $this->categoryService->getCategories($slug);

        return response()->json(['view' => view('components.delivery', compact('categories'))->render()]);
    }
}
