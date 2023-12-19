<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $callbacks = Callback::orderBy('id', 'DESC')->paginate(15);
        return view('admin.callbacks.index', compact('callbacks'));
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
        $callback = Callback::find($id);
        return view('admin.callbacks.edit', compact('callback'));
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
        $request->validate([
            'name' => 'required',
        ]);

        $callback = Callback::find($id);

        $callback->update([
            'name'         => $request->input('name'),
            'phone'       => $request->input('phone'),
            'email'       => $request->input('email'),
            'human'       => $request->input('human'),
            'date'        => $request->input('date'),
            'time'        => $request->input('time'),
            'type'        => $request->input('type'),
            'link'        => $request->input('link'),
            'status'      => $request->input('status'),
        ]);

        $request->session()->flash('success', 'Заявка обновлена');

        return redirect()->route('admin.callbacks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $callback = Callback::find($id);

        $callback->delete();

        return redirect()->route('admin.callbacks.index')->with('success', 'Заявка удалена');
    }
}
