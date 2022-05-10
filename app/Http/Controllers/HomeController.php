<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        $products = Product::with('subcategory')->get();
        $categories = Category::all();
        return view('home', compact('products','categories'));
    }

    public function searchProduct(Request $request)
    {
        $products = Product::with('subcategory')
            ->when($request->has('min_price'), function ($query) use ($request) {
                $query->whereBetween('price', [$request->min_price , $request->max_price]);
            }) // Todo need to fix this query
            ->when($request->has('title'), function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->title. '%');
            })
            ->when($request->has('subcategory'), function ($query) use ($request) {
                $query->where('subcategory_id', '=', $request->subcategory);
            })
            ->get();
        $categories = Category::all();
        return view('home', compact('products', 'categories'));
    }
}
