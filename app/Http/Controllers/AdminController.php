<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function login()
    {
        return view('user.create');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'password'  => 'required'
        ]);
        if (Auth::guard('admin')->attempt(['name' => $request->name, 'password' => $request->password])) {
            session()->flash('success', 'Вы успешно авторизованы');
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with('error', 'Неверные данные');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
