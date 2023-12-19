<?php

namespace App\View\Components;

use App\Models\Setting;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\View\Component;
use App\Models\Form as CallForm;

class Form extends Component
{
    public $id;

    /**
     * Create a new component instance.
     *
     * @param $id
     */
    public function __construct($id)
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
        $dt = Carbon::now()->format('H:i');

        $period = CarbonPeriod::create(Carbon::now()->format('d-m-Y'), Carbon::now()->addMonth(2)->format('d-m-Y'));

        $dates = $period->toArray();

        $hour = (int)substr($dt, 0, 2);
        $minute = (int)substr($dt, -2);

        $type = $this->id;
        $form = CallForm::find($type);
        $setting = Setting::find(1);
        return view('components.form', compact('setting', 'type', 'form', 'hour', 'minute', 'dates'));
    }
}
