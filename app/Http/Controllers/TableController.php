<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Bill;
use Illuminate\Http\Request;

class TableController extends Controller
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
            return redirect()->to('/settings#edit-table');
        } else {
            return view("components.edit_table");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'num_seats' => 'required|numeric',
        ]);

        $table = new Table();
        $table->name = $data["name"];
        $table->capacity = $data['num_seats'];
        $table->save();

        if ($request->header("hx-request") == null) {
            return redirect()->to('/settings#edit-table');
        } else {
            return view("components.edit_table", ['table' => $table]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Table $table)
    {
        if ($request->header("hx-request") == null) {
            return redirect()->to('/settings#edit-table');
        } else {
            return view("components.edit_table", ['table' => $table]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        $data = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required',
            'num_seats' => 'required|numeric',
        ]);

        $table->name = $data["name"];
        $table->capacity = $data['num_seats'];
        $table->save();

        if ($request->header("hx-request") == null) {
            return redirect()->to('/settings#edit-table');
        } else {
            return view("components.edit_table", ['table' => $table]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table) {
        $table->delete();
    }
}
