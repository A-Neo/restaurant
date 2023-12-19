<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Phone;
use Illuminate\Http\Request;

class StreetController extends Controller
{
    public function street(Request $request)
    {
        $phone = Phone::where('phone', $request->input('phone'))->first();

        $street = Address::create([
            'user_id'           => auth()->user()->getAuthIdentifier() ?? 0,
            'city'              => 'Москва',
            'address_line'      => $request->input('address_line'),
            'delivery_zone_id'  => $request->input('delivery_zone_id'),
            'zip_code'          => $request->input('zip_code'),
            'street'            => $request->input('street'),
            'house'             => $request->input('house'),
            'coordinates'       => implode(", ", $request->input('coordinates')),
            'flat'              => $request->input('flat'),
            'floor'             => $request->input('floor'),
            'entrance'          => $request->input('entrance'),
            'intercom'          => $request->input('intercom'),
        ]);

        $street->phones()->attach($phone->id);
    }
}
