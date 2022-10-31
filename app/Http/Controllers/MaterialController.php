<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("materials.index", [
            "title" => "Materials",
            "materials" => Material::get(),
            "saldo" => Account::latest()->limit(1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("materials.create", [
            "title" => "Materials",
            "saldo" => Account::latest()->limit(1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Material::create([
            "nama" => $request->nama,
            "tanggal_stok" => $request->tanggal_stok,
            "stok" => $request->stok,
        ]);

        return redirect("/materials");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view("materials.edit", [
            "title" => "Materials",
            "material" => $material,
            "saldo" => Account::latest()->limit(1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $material->update([
            "nama" => $request->nama,
            "tanggal_stok" => $request->tanggal_stok,
            "stok" => $request->stok,
        ]);

        return redirect("/materials");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect("/materials");
    }
}
