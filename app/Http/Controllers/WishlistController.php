<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{


    function index(){
        $items = Cart::instance('wishlist')->content();
        return view('wishlist', compact('items'));
    }

    function add_to_wishlist(Request $request){
        Cart::instance('wishlist')->add($request->id, $request->name, $request->quantity, $request->prince)->associate('App\Models\Product');
        return redirect()->back();
    }
}
