<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\View\Components\Street;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $address = Address::create([
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

        return response()->json(['success' => 'Адрес успешно сохранен', 'address' => $address]);
    }
}
