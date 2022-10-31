<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Product;
use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard', [
            "title" => "Dashboard",
            "jumlah_reseller" => Reseller::count(),
            "jumlah_produk" => Product::count(),
            "saldo" => Account::latest()->limit(1)->get(),
            "products" => Product::orderBy("terjual", "desc")->limit(5)->get(),
        ]);
    }
}
