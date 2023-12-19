<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;
use \App\Models\Product as Item;

class Product extends Component
{
    public $id;

    /**
     * Create a new component instance.
     *
     * @param $id
     */
    public function __construct($id = 0)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $product = Item::find($this->id);
        return view('components.product', compact('product'))->render();
    }

    public function update(Request $request)
    {
        $this->id = $request->input('id');
        return $this->render();
    }
}
