<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use function GuzzleHttp\Psr7\_parse_request_uri;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $id = $request->input('id');
        $product = Product::find($id);
        $cart = $request->session()->get('cart');

        if (!$request->session()->has('cart')) {
            session(['cart' => [
                $product->id => ['id' => $product->id, 'title_ru' => $product->title_ru, 'title_en' => $product->title_en, 'describe_ru' => $product->describe_ru, 'describe_en' => $product->describe_en, 'img' => $product->getImage(), 'price' => $product->price, 'qnt' => 1]
            ]]);
        } else {
            if (array_key_exists($product->id, $cart)) {
                foreach ($request->session()->get('cart') as $k => $v) {
                    if ($v['id'] == $product->id) {
                        $request->session()->put("cart.$k.qnt", $v['qnt'] + 1);
                    }
                }
            } else {
                $request->session()->put("cart.$product->id", ['id' => $product->id, 'title_ru' => $product->title_ru, 'title_en' => $product->title_en, 'describe_ru' => $product->describe_ru, 'describe_en' => $product->describe_en, 'img' => $product->getImage(), 'price' => $product->price, 'qnt' => 1]);
            }

        }

        return $request->session()->get("cart.$id.qnt");
    }

    public function plusProduct(Request $request)
    {
        $id = $request->input('id');
        $product = Product::find($id);
        $cart = $request->session()->get('cart');


        if (!$request->session()->has('cart')) {
            session(['cart' => [
                $product->id => ['id' => $product->id, 'title_ru' => $product->title_ru, 'title_en' => $product->title_en, 'describe_ru' => $product->describe_ru, 'describe_en' => $product->describe_en, 'img' => $product->getImage(), 'price' => $product->price, 'qnt' => 1]
            ]]);
        } else {
            if (array_key_exists($product->id, $cart)) {
                foreach ($request->session()->get('cart') as $k => $v) {
                    if ($v['id'] == $product->id) {
                        $request->session()->put("cart.$k.qnt", $v['qnt'] + 1);
                    }
                }
            } else {
                $request->session()->put("cart.$product->id", ['id' => $product->id, 'title_ru' => $product->title_ru, 'title_en' => $product->title_en, 'describe_ru' => $product->describe_ru, 'describe_en' => $product->describe_en, 'img' => $product->getImage(), 'price' => $product->price, 'qnt' => 1]);
            }

        }

        return session()->get("cart.$id.qnt");
    }

    public function minusProduct(Request $request)
    {
        $id = $request->input('id');
        $qnt = session()->get("cart.$id.qnt");

        if($qnt > 1) {
            session()->put("cart.$id.qnt", $qnt - 1);
        } else {
            session()->forget("cart.$id");

            if(count(session()->get('cart')) == 0) {
                session()->forget("cart");
                return 666;
            }

            return 555;
        }

        if(count(session()->get('cart')) == 0) {
            session()->forget("cart");
        }

        $res = session()->get("cart.$id.qnt") ?? 0;
        return $res;
    }

    public function cartDelete(Request $request)
    {
        $id = $request->input('id');
        session()->forget("cart.$id");

        return true;
    }

    public function countCart()
    {
        $count = 0;
        if (session()->has('cart')) {
            foreach(session()->get('cart') as $cart) {
                $count += $cart['qnt'];
            }
        }
        return $count;
    }
}
