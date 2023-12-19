<?php

namespace App\View\Components;

use App\Models\Phone;
use Illuminate\View\Component;
use Illuminate\Http\Request;

class Street extends Component
{
    public $phone;
    /**
     * Create a new component instance.
     *
     * @param null $phone
     */
    public function __construct($phone = null)
    {
        $this->phone = $phone;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user = auth()->user();
        return view('components.street', compact('user'))->render();
    }

    public function update()
    {
        return $this->render();
    }
}
