<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Algoritm;
use Illuminate\Http\Request;

class AlgoritmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $algoritm = Algoritm::find($id);
        return view('admin.algoritms.edit', compact('algoritm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $algoritm = Algoritm::find($id);

        $algoritm->update([
            'y1'   => $request->input('y1'),
            'y2'   => $request->input('y2'),
            'y3'   => $request->input('y3'),
            'x1'   => $request->input('x1'),
            'x2'   => $request->input('x2'),
            'z1'   => $request->input('z1'),
            'z2'   => $request->input('z2'),
            'z3'   => $request->input('z3'),
            'z4'   => $request->input('z4'),
            'z5'   => $request->input('z5'),
            'z6'   => $request->input('z6'),
            'z7'   => $request->input('z7'),
            'z8'   => $request->input('z8'),
            'z9'   => $request->input('z9'),
            'z10'   => $request->input('z10'),
            'z11'   => $request->input('z11'),
        ]);

        $request->session()->flash('success', 'Алгоритм - обновлен');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
