<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

use App\Models\Table;
use App\Models\Bill;
use App\Models\MenuItem;

use App\Http\Controllers\MenuItemController;

/// Figure out how to send a redirect, according to the HX-Request header.
function regular_or_htmx_redirect(
    Request $request,
    string $to,
    array|null $errors = null
): Response|RedirectResponse {
    if ($request->header("hx-request") == null) {
        if($errors != null) {
            return redirect()->withErrors($errors)->to($to);
        } else {
            return redirect()->to($to);
        }
    } else {
        return response('', 204, ['HX-Redirect' => $to]);
    }
}

Route::get('/', function () {
    return redirect()->to("/hub");
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->intended('/hub');
    }

    return view("login");
});

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'name' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
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

    foreach ($all_tables as $table) {
        if ($table->is_taken) {
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

Route::post("/bills/create", function (Request $request) {
    $table_id = $request->validate(["table_id" => ["required"]])["table_id"];
    $table = Table::find($table_id);

    if ($table == null) {
        return back()->withErrors([
            'table_id' => 'Invalid table ID!'
        ]);
    } else if ($table->isTaken()) {
        return back()->withErrors([
            'table_id' => 'This table is already taken!'
        ]);
    }

    $bill = new Bill();
    $bill->time_closed = null;
    $bill->is_payed = false;
    $bill->tip_amount = 0;
    $bill->table()->associate($table);
    $bill->save();

    return regular_or_htmx_redirect($request, "/orders");
});

// Route::resource()

Route::post('/bills/{bill_id}/add/{menu_item_id}', function (
    Request $request,
    int $bill_id,
    int $menu_item_id
) {
    $bill = Bill::findOrFail($bill_id);
    $menu_item = MenuItem::findOrFail($menu_item_id);

    if ($bill->isClosed()) {
        return regular_or_htmx_redirect($request, '/orders', [
            'bill' => "Bill $bill_id is already closed and no items can be added to it."
        ]);
    }


    $bill->menuItems()->attach([$menu_item_id]);
    $menu_item = $bill->menuItems()->find($menu_item_id);

    return view("components.bill_menu_item", [
        'bill' => $bill,
        'menuItem' => $menu_item,
        'is_oob' => true,
    ]);
})->middleware('auth');

Route::delete('/bills/{bill_id}/{menu_item_id}', function(
    int $bill_id,
    int $menu_item_id
) {
    $bill = Bill::findOrFail($bill_id);
    $bill->menuItems()->detach([$menu_item_id]);
});

Route::post('/bills/{bill_id}/{menu_item_id}/update_amount', function(
    Request $request,
    int $bill_id,
    int $menu_item_id
) {
    $bill = Bill::findOrFail($bill_id);
    $menuItem = $bill->menuItems()->findOrFail($menu_item_id);


    $qty = $request->validate(['quantity' => 'required|int'])['quantity'];

    $bill->menuItems()->updateExistingPivot(
        $menu_item_id,
        [ 'quantity' => $menuItem->pivot->quantity + $qty ]
    );

    $menuItem->refresh();
    $menuItem->pivot->refresh();

    return view("components.bill_menu_item", [
        'bill' => $bill,
        'menuItem' => $menuItem,
    ]);
})->middleware('auth');

Route::post('/bills/{bill_id}/close', function(
    Request $request,
    int $bill_id
) {
    $bill = Bill::findOrFail($bill_id);

    if ($bill->isClosed()) {
        return regular_or_htmx_redirect($request, '/orders', [
            'bill' => "Bill $bill_id is already closed."
        ]);
    }

    $bill->is_payed = true;
    $bill->time_closed = Carbon::now();
    $bill->save();

    return regular_or_htmx_redirect($request, '/orders');
})->middleware('auth');

Route::get('/orders', function () {
    $openBills = Bill::open()->orderBy("created_at", "desc")->get();

    return view("orders", [
        "openBills" => $openBills
    ]);
})->middleware('auth');

Route::get('/orders/{id}', function (int $id) {
    $bill = Bill::findOrFail($id);
    $billMenuItems = $bill->menuItems()->allRelatedIds();

    $menuItems = MenuItem::all()->whereNotIn('id', $billMenuItems);

    return view("order_view", [
        'bill' => $bill,
        'menu_items' => $menuItems,
    ]);
})->middleware('auth');

Route::view('/analytics', 'analytics')->middleware('auth');

Route::get('/settings', function() {
    return view('settings', [
        'menu_items' => MenuItem::upToDate()->get(),
    ]);
})->middleware('auth');

Route::resource('/menu_items', MenuItemController::class)->middleware('auth');
