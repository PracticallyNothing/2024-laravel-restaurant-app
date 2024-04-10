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

Route::view('/hub', 'hub')->middleware('auth');
Route::get('/tables-and-seating', function () {
    // NOTE(Mario):
    //   Не мога да ползвам модела Table тук, тъй като искам да проверя за съотношение
    //   между две таблици, а не видях модела да позволява такова нещо.
    //
    //   Както винаги, оказва се че прост SQL е по-добре...
    $all_tables = DB::select(
        'select T.*, exists(select * from bills where time_closed is NULL and table_id = T.id) as is_taken
         from tables as T'
    );

    $free_tables = array();
    $taken_tables = array();

    foreach($all_tables as $table) {
        if($table->is_taken){
            array_push($taken_tables, $table);
        } else {
            array_push($free_tables, $table);
        }
    }

    // $free_tables = ;
    return view('tables-and-seating', [
        'free_tables' => $free_tables,
        'taken_tables' => $taken_tables,
    ]);
})->middleware('auth');
