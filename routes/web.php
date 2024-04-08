<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    if(Auth::check()) {
        return redirect()->intended('/hub');
    }

    return view("login");
});

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'name' => ['required'],
        'password' => ['required'],
    ]);

    if(Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended("/hub");
    }

    Log::info("Failed login!");

    return back()->withErrors([
        'name' => 'Incorrect username or password! Please try again!'
    ])->onlyInput('username');
});

Route::post("/logout", function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect("/login");
});

Route::view("/hub", "hub")->middleware('auth');
