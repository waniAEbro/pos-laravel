<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Product;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("products.index", [
            "title" => "Products",
            "products" => Product::get(),
            "saldo" => Saldo::find(1)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create", [
            "title" => "Products",
            "materials" => Material::get(),
            "categories" => Category::get(),
            "saldo" => Saldo::find(1)
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
        $sync = [];
        foreach ($request->materials as $index => $material) {
            if ($material != null) {
                $sync[$material] = ["jumlah" => $request->jumlah[$index]];
            }
        }
        $product = Product::create([
            "nama" => $request->nama,
            "category_id" => $request->category,
            "harga" => $request->harga,
            "harga_reseller" => $request->harga_reseller,
            "stok" => $request->stok,
            "biaya_produksi" => $request->biaya_produksi
        ]);

        $product->materials()->sync($sync);

        return redirect("/products");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view("products.edit", [
            "title" => "Products",
            "product" => $product,
            "materials" => Material::get(),
            "categories" => Category::get(),
            "saldo" => Saldo::find(1)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $sync = [];
        foreach ($request->materials as $index => $material) {
            if ($material != null) {
                $sync[$material] = ["jumlah" => $request->jumlah[$index]];
            }
        }
        $product->update([
            "nama" => $request->nama,
            "category_id" => $request->category,
            "harga" => $request->harga,
            "harga_reseller" => $request->harga_reseller,
            "biaya_produksi" => $request->biaya_produksi
        ]);

        $product->materials()->sync($sync);

        return redirect("/products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect("/products");
    }
}
