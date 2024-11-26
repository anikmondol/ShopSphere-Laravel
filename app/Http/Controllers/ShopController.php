<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    function index()
    {
        $products = Product::orderBy("created_at", "DESC")->paginate(12);
        return view("shop", compact('products'));
    }


    function product_details($product_slug) {
        $product = Product::where('slug', $product_slug)->first();
        $r_products = Product::where('slug','<>', $product_slug)->get()->take(8);
        return view("details", compact('product', 'r_products'));
    }

}
