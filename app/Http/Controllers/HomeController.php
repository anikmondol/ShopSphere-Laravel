<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{



    public function index()
    {
        $slides = Slide::where('status',1)->get()->take(3);
        $categories = Category::orderBy('name')->get();
        $sProducts = Product::whereNotNull('sale_price')->where('sale_price','<>','')->inRandomOrder()->get()->take(8);
        $fProducts = Product::where('featured',1)->get()->take(8);
        return view('index',compact("slides", "categories","sProducts","fProducts"));
    }

    function contact(){
        return view('contact');
    }

    function contact_store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        $contact = new Contact();

        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->comment = $request->comment;

        $contact->save();
        return redirect()->back()->with('success',"Your message has been send successfully");
    }


    function search(Request $request){

        $query = $request->input('query');
        $results = Product::where('name',"LIKE","%{$query}%")->get()->take(8);
        return response()->json($results);

    }



}
