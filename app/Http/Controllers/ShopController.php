<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    function index(Request $request)
    {

        $o_column = "";
        $o_order = "";
        $size = $request->query('size') ? $request->query('size') : 12;
        $order = $request->query('order') ? $request->query('order') : -1;
        switch ($order) {
            case 1:
                $o_column = 'created_at';
                $o_order = 'DESC';
                break;
            case 2:
                $o_column = 'created_at';
                $o_order = 'ASC';
                break;
            case 3:
                $o_column = 'sale_price';
                $o_order = 'ASC';
                break;
            case 4:
                $o_column = 'sale_price';
                $o_order = 'DESC';
                break;

            default:
                $o_column = 'id';
                $o_order = 'DESC';
                break;
        }
        $products = Product::orderBy($o_column, $o_order)->paginate($size);
        return view("shop", compact('products', 'size', 'order'));
    }


    function product_details($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $r_products = Product::where('slug', '<>', $product_slug)->get()->take(8);
        return view("details", compact('product', 'r_products'));
    }
}