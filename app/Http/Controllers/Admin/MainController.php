<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $product = Product::all()->count();
        $category = Category::all()->count();
        $user = User::all()->count();
        $order = Order::all()->count();
        return view('admin.index', compact('product', 'category', 'user', 'order'));
    }
}
