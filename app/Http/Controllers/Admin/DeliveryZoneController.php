<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KMLParser;
use App\Models\DeliveryZone;
use Illuminate\Http\Request;

class DeliveryZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = DeliveryZone::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.deliveries.index', compact('pages'));
    }

    public function store(Request $request)
    {
        $coordinates = $this->uploadKML($request);

        $zone = DeliveryZone::create([
            'title' => $request->input('title'),
            'price' => $request->input('price') ?? '',
            'min_amount' => $request->input('min_amount'),
            'free_delivery' => $request->input('free_delivery'),
            'min_time' => $request->input('min_time'),
            'max_time' => $request->input('max_time'),
            'restaurant_id' => 1,
            'coordinates' => $coordinates
        ]);
        return redirect()->route('admin.deliveries.index');
    }

    public function show(DeliveryZone $zone)
    {
        return view('admin.delivery.show', compact('zone'));
    }

    public function update(Request $request, $id)
    {
        $delivery = DeliveryZone::find($id);
        $delivery->update([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'min_amount' => $request->input('min_amount'),
            'free_delivery' => $request->input('free_delivery'),
            'min_time' => $request->input('min_time'),
            'max_time' => $request->input('max_time'),
            'restaurant_id' => 1,
        ]);
        if ($request->hasFile('zone')) {
            $coordinates = $this->uploadKML($request);
            $delivery->update([
                'coordinates' => $coordinates,
            ]);
        }
        return redirect()->route('admin.deliveries.index');
    }

    public function destroy($id)
    {
        $delivery = DeliveryZone::find($id);
        $delivery->delete();
        return redirect()->route('admin.deliveries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.deliveries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($zone)
    {
        $delivery = DeliveryZone::find($zone);
        return view('admin.deliveries.edit', compact('delivery'));
    }

    public function uploadKML(Request $request)
    {
        $file = $request->file('zone');
        $parser = new KMLParser($file->path());
        $zones = $parser->parseDeliveryZones();
        return json_encode($zones[0]['coordinates']);
    }
}
