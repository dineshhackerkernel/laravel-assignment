<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
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
        $products = Product::where('user_id',auth()->user()->id)->get();
        return view('home',compact('products'));
    }
    public function addProduct(Request $request){
        $request->validate([
            'product_name' => 'required',
        ]);
        $add = new Product();
        $add->product_name = $request->product_name;
        $add->user_id = auth()->user()->id;
        $add->save();
        $request->session()->flash('alert-success', 'Product Added successfully!');
        return redirect()->back();
    }
}
