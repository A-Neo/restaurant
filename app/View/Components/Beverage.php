<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;
use App\Models\Beverage as Listing;

class Beverage extends Component
{
    public $id;
    public $category;

    /**
     * Create a new component instance.
     *
     * @param  int $id
     *
     * @return void
     */
    public function __construct($id = null)
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
        if ($this->category) {
            $foods = Listing::find($this->id)->categories->where('id', $this->category);
            return view('components.beverage', compact('foods'))->render();
        }

        $foods = Listing::find($this->id)->categories->sortBy('order');
        return view('components.beverage', compact('foods'))->render();
    }

    public function update(Request $request)
    {
        $this->id = $request->input('id');

        if ($request->input('category')) {
            $this->category = $request->input('category');
        }

        return $this->render();
    }
}
