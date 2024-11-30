<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    function index(){
        return view("user.index");
    }

    function orders(){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at',"DESC")->paginate(10);
        return view('user.orders',compact('orders'));
    }

    public function order_details($order_id)
    {

        $order = Order::where('user_id',Auth::user()->id)->where('id',$order_id)->first();

       if ($order) {

         $orderItems = OrderItem::where('order_id', $order->id)
         ->orderBy('id')
         ->paginate(10);


         $transaction = Transaction::where('order_id', $order_id)->first();


        return view('user.order-details', compact('order', 'orderItems', 'transaction'));

       }else{
        return redirect()->route('login');
       }


    }

}
