<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
        $f_brands = $request->query('brands');
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
        // $brands = Brand::where(function($query) use($f_brands){
        //     $query->whereIn("brand_id", explode(',', $f_brands))->orwhereRaw("'='".$f_brands."'");
        // })->orderBy("name", "ASC")->get(',', $f_brands);
        // $products = Product::orderBy($o_column, $o_order)->paginate($size);


        $brands = Brand::orderBy('name', 'ASC')->get();
        $products = Product::when(!empty($f_brands), function ($query) use ($f_brands) {
            $brands = explode(',', $f_brands);
            // Only add the whereIn clause if $brands is not empty
            if (!empty($brands)) {
                $query->whereIn('brand_id', $brands);
            }
        })->orderBy($o_column, $o_order)->paginate($size);


        return view("shop", compact('products', 'size', 'order', 'brands', 'f_brands'));
    }


    function product_details($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $r_products = Product::where('slug', '<>', $product_slug)->get()->take(8);
        return view("details", compact('product', 'r_products'));
    }
}
