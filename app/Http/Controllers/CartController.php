<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //

    function index(){
        $items = Cart::instance('cart')->content();
        return view('cart', compact('items'));
    }


    function add_to_cart(Request $request){
        Cart::instance('cart')->add($request->id, $request->name, $request->quantity, $request->price)->associate('App\Models\Product');
        return redirect()->back();
    }

    function increase_cart_quantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    function decrease_cart_quantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    function remove_item($rowId){
        Cart::instance('cart')->remove($rowId);
        return redirect()->back();
    }

    function empty_cart(){
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    function apply_coupon_code(Request $request)
    {

        $coupon_code = $request->coupon_code;

        if (isset($coupon_code)) {
            $coupon = Coupon::where('code', $coupon_code)->where('expiry_date', '>=', Carbon::today())->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();
            if (!$coupon) {
                return redirect()->back()->with("error", "Invalid coupon code!");
            } else {
                Session::put('coupon',[
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'cart_value' => $coupon->cart_value,
                ]);

                $this->calculateDiscount();
                return redirect()->back()->with("success", "Coupon has been applied!");
            }

        } else {
            return redirect()->back()->with("error", "Invalid coupon code!");
        }
    }

    function calculateDiscount(){
        $discount = 0;

        if (Session::has('coupon')) {
           if(Session::get('coupon')['type']=='fixed'){
            $discount = Session::get('coupon')['value'];
           }else{
            $discount = (Cart::instance('cart')->subtotal() * Session::get('coupon')['value']) / 100;
           }

           $subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $discount;
           $taxAfterDiscount =  ($subtotalAfterDiscount * config('cart.tax'))/100;
           $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscount;

           Session::put('discounts',[
            'discount' => number_format(floatval($discount),2,'.',''),
            'subtotal' => number_format(floatval($subtotalAfterDiscount),2,'.',''),
            'tax' => number_format(floatval($taxAfterDiscount),2,'.',''),
            'total' => number_format(floatval($totalAfterDiscount),2,'.',''),
           ]);


        }


    }

}
