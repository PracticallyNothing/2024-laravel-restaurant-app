<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->header("hx-request") == null) {
            return redirect()->to('/settings#edit-menu');
        } else {
            return view("components.edit_menu_item");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price_bgn' => 'required|numeric',
        ]);

        $item = new MenuItem();
        $item->name = $data['name'];
        $item->price_bgn = $data['price_bgn'];

        $item->save();

        if ($request->header("hx-request") == null) {
            return view("components.edit_menu_item");
        } else {
            return redirect()->to('/settings#edit-menu');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem) {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menuItem)
    {
        return view("components.edit_menu_item", ['menuItem' => $menuItem]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $data = $request->validate([
            'name' => 'required',
            'price_bgn' => 'required|numeric',
        ]);

        $updatedMenuItem = new MenuItem();
        $updatedMenuItem->name = $data['name'];
        $updatedMenuItem->price_bgn = $data['price_bgn'];
        $updatedMenuItem->save();

        $updatedMenuItem->prevRevision()->save($menuItem);
        $menuItem->nextRevision()->associate($updatedMenuItem);
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
    }
}
