<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("resellers.index", [
            "title" => "Resellers",
            "resellers" => Reseller::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("resellers.create", [
            "title" => "Resellers"
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
        Reseller::create([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "nomor" => $request->nomor
        ]);

        return redirect("/resellers");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function show(Reseller $reseller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function edit(Reseller $reseller)
    {
        return view("resellers.edit", [
            "title" => "Resellers",
            "reseller" => $reseller
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reseller $reseller)
    {
        $reseller->update([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "nomor" => $request->nomor
        ]);

        return redirect("/resellers");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reseller $reseller)
    {
        $reseller->delete();

        return redirect("/resellers");
    }
}
