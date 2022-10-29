<?php

namespace App\Http\Controllers;

use App\Models\Debit;
use App\Models\Product;
use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DebitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("debits.index", [
            "title" => "Debits",
            "debits" => Debit::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("debits.create", [
            "title" => "Transactions",
            "products" => Product::get(),
            "resellers" => Reseller::get(),
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debit  $debit
     * @return \Illuminate\Http\Response
     */
    public function show(Debit $debit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debit  $debit
     * @return \Illuminate\Http\Response
     */
    public function edit(Debit $debit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Debit  $debit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debit $debit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debit  $debit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debit $debit)
    {
        //
    }
}
